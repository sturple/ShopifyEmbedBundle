<?php

namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Model\ShopifyApp;
use \Fgms\ShopifyBundle\Entity\ShopifyShopSettings;


class ShopifyOrdersController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$store_name,
		$redirect_url,
		$template_array = array();    

   
    public function indexAction(Request $request){
        $this->request = $request;   
        $name = 'shopify';
        return $this->render('FgmsShopifyBundle:Default:index.html.twig', array('name' => $name));
    }
    
  

    

    

    private function get_app_settings() {
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);	

    }
    
  
    
 
}




