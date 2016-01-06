<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;


class ShopifySpecialPageController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$theme,
		$store_name,
		$redirect_url,
		$template_array = array();
		
		
	public function indexAction(){
		$this->get_app_settings();		
		$this->template_array['title'] ='Specials ';
		$lps = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Specials')
			->findBy(array('status'=>'active','shop'=>$this->store_name),array('id'=>'ASC'));
		$this->template_array['specials'] = $lps;
		return $this->render('FgmsShopifyBundle:ShopifySpecialsPage:index.html.twig',$this->template_array); 			
	}
	

	
	public function editAction($id){
		$id = intval($id);
		$this->get_app_settings();	
		$specials = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Specials')
			->findOneBy(array('id'=>$id),array('id'=>'ASC'));
		// create a new one if not exists
		if (!$specials){
			$specials = new Specials();
			$specials->setCreateDate();
			$specials->setShop($this->store_name);
			
		}
		$this->template_array['title'] ='Specials: ' .$specials->getTitle();
		$this->template_array['specials'] = $specials;
		$form = $this->createForm(new LandingPageType(),$specials);
		
		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){	
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			if ($specials->getId() > 0){
				return $this->redirect('/shopify/specials/'.$specials->getId());
			}
			
		}
		$this->template_array['form'] = $form->createView();
			
		return $this->render('FgmsShopifyBundle:ShopifySpecialsPage:form.html.twig',$this->template_array);			
		
	}	
	
	public function publicAction($permalink){		
		$this->get_app_settings();
		$this->template_array['title'] ='Specials ';
		
		$lp = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Specials')
			->findOneBy(array('permalink'=>$permalink),array('id'=>'ASC'));
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
		
		$this->template_array['form'] = $form->createView();		
		$this->template_array['lp'] = $lp;
		$this->template_array['formGlobals'] = $this->get('fgms.settings')->getFormSettings($this->store_name);
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyLandingPage:public.html.twig',$this->template_array);	
	}
	



	private function renderAsLiquid($template, $array=array()){
		$response = new Response(
			'Content',
			Response::HTTP_OK,
			array('content-type' => 'application/liquid')
		);
		$response->setContent('{% assign landingpage = true %}' .$this->renderView($template, $array));
		return $response;
	}	
	

	
    private function get_app_settings() {		
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);	
    }


}