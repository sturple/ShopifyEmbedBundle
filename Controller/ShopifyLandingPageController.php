<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Entity\LandingPage;
use \Fgms\ShopifyBundle\Form\LandingPageQRType;
use \Fgms\ShopifyBundle\Form\LandingPagePPCType;
use \Fgms\ShopifyBundle\Form\LandingPagePartnerStoreType;
use \Fgms\ShopifyBundle\Entity\LandingPageInquiry;
use \Fgms\ShopifyBundle\Form\LandingPageInquiryType;
use \Fgms\ShopifyBundle\Entity\EventTracking;

class ShopifyLandingPageController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$theme,
		$store_name,
		$redirect_url,
		$liquidStr = '{% assign landingpage = true %}',
		$template_array = array();


	public function indexAction(){
		$this->get_app_settings();
		$this->template_array['title'] ='Landing Pages ';
		$lps = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:LandingPage')
			->findBy(array('status'=>'active','shop'=>$this->store_name),array('id'=>'ASC'));
		$this->template_array['landingpages'] = $lps;
		return $this->render('FgmsShopifyBundle:ShopifyLandingPage:index.html.twig',$this->template_array);
	}

	public function trackAction() {
		$this->get_app_settings();
		$session = $this->getRequest()->getSession();
		$et = new EventTracking();
		$et->setEventDate();
		$et->setShop($this->store_name);
		$et->setLandingPageId($this->get('request')->request->get('id',0));
		$et->setEventCategory($this->get('request')->request->get('category',''));
		$et->setEventLabel($this->get('request')->request->get('label',''));
		$et->setEventAction($this->get('request')->request->get('action',''));
		$et->setIpAddress($this->get('request')->server->get('HTTP_X_REAL_IP'));
		$et->setRefererUrl($this->get('request')->request->get('referrer',''));
		//$et->setRefererUrl($this->get('request')->session-('HTTP_REFERER');
		$em = $this->getDoctrine()->getManager();
		//$et->setTracking($this->get('request')->request->all());
		$em->persist($et);
		$em->flush();

		$status = 'success';
		$response = new Response(json_encode(array('status' => $status)));
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}

	public function editQRAction($id){
		$id = intval($id);
		$this->get_app_settings();
		$lp = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:LandingPage')
			->findOneBy(array('id'=>$id),array('id'=>'ASC'));
		// create a new one if not exists
		if (!$lp){
			$lp = new LandingPage();
			$lp->setCreateDate();
			$lp->setShop($this->store_name);
			$lp->setType('qr');
			$lp->setTemplate('publicQR.html.twig');

		}
		$this->template_array['title'] ='QR Landing Page: ' .$lp->getTitle();
		$this->template_array['lp'] = $lp;
		$form = $this->createForm(new LandingPageQRType(),$lp);

		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			if ($lp->getId() > 0){
				return $this->redirect('/shopify/lp/qr/'.$lp->getId());
			}
		}
		$this->template_array['form'] = $form->createView();
		return $this->render('FgmsShopifyBundle:ShopifyLandingPage:formQR.html.twig',$this->template_array);

	}

	public function editPartnerStoreAction($id){
		$id = intval($id);
		$this->get_app_settings();
		$snippet_raw = ShopifyClient::get_assets($this->shopify);
		$snippet_choice = array();
		foreach ($snippet_raw as $snippet){
			$snippet_choice[$snippet] = $snippet;
		}
		$collection_choice = ShopifyClient::get_collections($this->shopify, $this->logger);

		$lp = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:LandingPage')
			->findOneBy(array('id'=>$id,'shop'=>$this->store_name),array('id'=>'ASC'));
		// create a new one if not exists
		if (!$lp){
			$lp = new LandingPage();
			$lp->setCreateDate();
			$lp->setShop($this->store_name);
			$lp->setType('ps');
			$lp->setTemplate('publicPartnerStore.html.twig');

		}
		$this->template_array['title'] ='Partner Store: ' .$lp->getTitle();
		$this->template_array['lp'] = $lp;
		$form = $this->createForm(new LandingPagePartnerStoreType($snippet_choice,$collection_choice),$lp);

		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			if ($lp->getId() > 0){
				// lets create shortlink
				return $this->redirect('/shopify/lp/ps/'.$lp->getId());
			}

		}
		$this->template_array['form'] = $form->createView();
		return $this->render('FgmsShopifyBundle:ShopifyLandingPage:formPartnerStore.html.twig',$this->template_array);

	}

	public function editPPCAction($id)
	{
		$this->get_app_settings();
		$snippet_raw = ShopifyClient::get_assets($this->shopify);
		$snippet_choice = array();
		foreach ($snippet_raw as $snippet){
			$snippet_choice[$snippet] = $snippet;
		}
		$id = intval($id);

		$lp = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:LandingPage')
			->findOneBy(array('id'=>$id,'shop'=>$this->store_name),array('id'=>'ASC'));
		// create a new one if not exists
		if (!$lp){
			$lp = new LandingPage();
			$lp->setCreateDate();
			$lp->setShop($this->store_name);
			$lp->setType('ppc');
			$lp->setTemplate('publicPPC.html.twig');
			$lp->setPostContent('aboutus-default');
		}

		$this->template_array['title'] ='PPC Landing Page: ' .$lp->getTitle();
		$this->template_array['lp'] = $lp;
		$form = $this->createForm(new LandingPagePPCType($snippet_choice),$lp);

		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			if ($lp->getId() > 0){
				return $this->redirect('/shopify/lp/ppc/'.$lp->getId());
			}
		}
		$this->template_array['form'] = $form->createView();
		return $this->render('FgmsShopifyBundle:ShopifyLandingPage:formPPC.html.twig',$this->template_array);
	}

	public function publicAction($permalink){
		$this->get_app_settings();
		$this->template_array['title'] ='Landing Page ';

		$lp = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:LandingPage')
			->findOneBy(array('permalink'=>$permalink,'shop'=>$this->store_name),array('id'=>'ASC'));
		if (!$lp){
			return $this->redirect('https://' .$this->store_name.'/404/');
		}

		$lpInquiry = new LandingPageInquiry();
		if ($lpInquiry->getCreateDate() == null){
			$lpInquiry->setLandingPageId($lp->getId());
			$lpInquiry->setIpAddress($this->get('request')->server->get('HTTP_X_REAL_IP'));
			$lpInquiry->setCreateDate();
			$lpInquiry->setShop($this->store_name);
		}

		$lpit = new LandingPageInquiryType();
		//$this->logger->notice('landing page inquiry type '.print_R($lpit->getOptions(),true));
		$form = $this->createForm($lpit,$lpInquiry);

		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			$this->get('fgms.mailer')->sendLandingPageEmail($lpInquiry,$this->get('fgms.settings')->getFormSettings($this->store_name));
			//$this->sendEmailMessage($form, $formType);

		}
		$template = ($lp->getTemplate() != null) ? $lp->getTemplate() : 'publicPPC.html.twig';

   	$this->logger->error('TEMPLATE:: '.$template);
		//$order = $this->shopify->call('GET','/admin/products/'.$productId.'.json');
		$this->template_array['form'] = $form->createView();
		$this->template_array['lp'] = $lp;
		$this->template_array['markdownContent'] =  $this->get('markdown.parser')->transformMarkdown($lp->getContent());
		$this->template_array['markdownSidebar'] =  $this->get('markdown.parser')->transformMarkdown($lp->getSidebarContent());
		$this->template_array['markdownAnnouncement'] =  $this->get('markdown.parser')->transformMarkdown($lp->getAnnouncement());
		$this->template_array['formGlobals'] = $this->get('fgms.settings')->getFormSettings($this->store_name);
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyLandingPage:'.$template, $lp->getTemplateOverride(),$this->template_array);
	}

	private function renderAsLiquid($template, $templateOverride, $array=array()){
		$response = new Response(
			'Content',
			Response::HTTP_OK,
			array('content-type' => 'application/liquid')
		);
		// logic to check is there is a store custom template it is the storename with out the .myshopify.com ie mystore.myshopify.com store name would be mystore
		$matches = null;
    // checks if templateOverride is not empty and exists.
    if ((!empty($templateOverride)) AND ($this->get('templating')->exists($templateOverride))){
      $template = $templateOverride;
    }
    // will check to see if their is a custom website one fallback will always be standard template.
    else {
      preg_match('/^[A-Za-z0-9-_]+/', $this->store_name, $matches);
  		if ($matches){
  			$count = null;
  			$sitetext = $matches[0] . '.html.twig';
  			$customTemplate = preg_replace('/html\\.twig$/',$sitetext , $template, -1, $count);
  			// sets custom store template ie 'FgmsShopifyBundle:ShopifyLandingPage:publicPPC.mystore.html.twig' ... mystore.myshopify.com
  			if (($count > 0) and ($this->get('templating')->exists($customTemplate)) ){
  				$template = $customTemplate;
  			}
  		}
    }

		$this->logger->notice('template '. $template);
		$response->setContent($this->liquidStr .$this->renderView($template, $array));
		return $response;
	}

	private function get_form_online(){
		$online = new ContactOnline();
		$online->setIp($this->get('request')->server->get('HTTP_X_REAL_IP'));
		if ($online->getCreateDate() == null){
			$online->setCreateDate();
		}
		$online->setFormType('Landing Page');
		$online->setReturnUrl('/pages/contact');
		$form = $this->createFormBuilder($online,array('csrf_protection' => false))
            ->add('firstName')
            ->add('lastName')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('province')
            ->add('postal')
            ->add('country')
            ->add('message')
            ->add('email')
            ->add('listA',null, array('label'=>'Subscribe to email list','required'=>false))
			->add('save','submit',array('label'=>'Submit Inquiry'))
			->getForm();
		return $form;
	}

    private function get_app_settings() {
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'',
									 'output'=>'',
									 'products'=>array(),
									 'shop_name'=>$settings['shop'],
									 'storeUrl' =>$settings['storeUrl'],
									 'proxyUrl' =>$settings['proxyUrl'],
									 'app_api'=>$settings['api_key']);
    }
}
