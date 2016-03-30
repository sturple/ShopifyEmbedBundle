<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;
use \Fgms\ShopifyBundle\Entity\Specials;
use \Fgms\ShopifyBundle\Form\SpecialsType;
use \Fgms\ShopifyBundle\Model\ShopifyClient;


class ShopifyWarrantyController extends Controller {
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
		$this->template_array['title'] ='Warranty ';
		$warranties = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Warranty')
			->findBy(array('status'=>'active','shop'=>$this->store_name),array('id'=>'ASC'));
		$this->template_array['warranties'] = $warranties;

		return $this->render('FgmsShopifyBundle:ShopifyWarranty:index.html.twig',$this->template_array);
	}




	public function publicAction(){
		$this->get_app_settings();
		$this->template_array['title'] ='Warranty ';
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyWarranty:public.html.twig',$this->template_array);
	}




	private function renderAsLiquid($template, $array=array()){
		$response = new Response(
			'Content',
			Response::HTTP_OK,
			array('content-type' => 'application/liquid')
		);
		$response->setContent($this->renderView($template, $array));
		return $response;
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
									 'shop'=>$settings['shop'],
									 'path_prefix'=>$this->get('request')->query->get('path_prefix'),
									 'app_api'=>$settings['api_key']);
    }


}
