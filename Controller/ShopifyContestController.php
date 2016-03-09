<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Fgms\ShopifyBundle\Model\ShopifyClient;

use \Fgms\ShopifyBundle\Entity\ContestEntry;
use \Fgms\ShopifyBundle\Form\ContestEntryType;

class ShopifyContestController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$theme,
		$store_name,
		$redirect_url,
        $liquidStr = "{% include 'shortcode-classic-series' %}",
		$template_array = array();


	public function indexAction(){
		$this->get_app_settings();
		return $this->render('FgmsShopifyBundle:ShopifyContest:index.html.twig',$this->template_array);
	}



	public function publicAction($permalink){
		$this->get_app_settings();
		$this->template_array['title'] ='Contest ';
		$contestEntry = new ContestEntry();
		if ($contestEntry->getCreateDate() == null){
			$contestEntry->setIpAddress($this->get('request')->server->get('HTTP_X_REAL_IP'));
			$contestEntry->setCreateDate();
            $contestEntry->setUpdateDate();
			$contestEntry->setShop($this->store_name);
            $contestEntry->setContestId($permalink);
		}

		$contestEntryType = new ContestEntryType();
		//$this->logger->notice('landing page inquiry type '.print_R($lpit->getOptions(),true));
		$form = $this->createForm($contestEntryType,$contestEntry);

		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
            $this->logger->notice('Form is valid ');
            $this->logger->error(print_R($form->getData(),true));
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
            return $this->redirect('/../../pages/product-question-delivered');
			//$this->get('fgms.mailer')->sendContestEmail($contestEntry,$this->get('fgms.settings')->getFormSettings($this->store_name));
			//$this->sendEmailMessage($form, $formType);

		}
		$this->template_array['form'] = $form->createView();
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyContest:contest.html.twig',$this->template_array);
	}

	private function renderAsLiquid($template, $array=array()){
		$response = new Response(
			'Content',
			Response::HTTP_OK,
			array('content-type' => 'application/liquid')
		);
		$response->setContent(str_replace('[[headingSnippet]]',$this->liquidStr,$this->renderView($template, $array)));
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
