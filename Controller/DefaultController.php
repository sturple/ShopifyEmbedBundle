<?php

namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Model\ShopifyApp;
use \Fgms\ShopifyBundle\Entity\ShopifyShopSettings;

class DefaultController extends Controller {
    var  $cdata = array(),
        $errors = array(),
        $post_flag = false,
        $options = array(),
        $debug_flag ,
        $formtype = '',
        $api_key=false,
        $shared_secret=false,
        $scope="read_content,write_content,read_products,write_products,read_customers,read_orders,read_script_tags,write_script_tags,read_fulfillments,read_themes,write_themes",
        $redirect_url="",
        $store_name='',
        $shopify=null,
        $logger = null,
        $request = null,
        $session = null,
        $template_array = array(),
        $_diag = array();


   public function __construct(){

   }

    public function indexAction(Request $request){
        $this->request = $request;
        $name = 'shopify';
        return $this->render('FgmsShopifyBundle:Default:index.html.twig', array_merge(array('name' => $name),$this->template_array));
    }

     public function productsAction(){
		$this->get_app_settings();
        $this->template_array['title'] ='Product Index';
		$this->template_array['products'] = $this->shopify->call('GET','/admin/products.json', array('limit'=>250));
		return $this->render('FgmsShopifyBundle:Default:index.html.twig', $this->template_array);
	}



    public function oauthAction(Request $request){
		$this->logger = $this->get('logger');
        $this->request = $request;
        $session = $this->get('request')->getSession();

		$this->logger->notice('----->oauth  Request Shop- '.$request->query->get('shop'));
		$this->logger->notice('----->oauth  Session Shop- '.$session->get('shop'));

       // $this->store_name = $session->has('shop') ? $session->get('shop') : $request->query->get('shop');
        $this->store_name = $request->query->has('shop') ? $request->query->get('shop'): $session->get('shop')  ;
        $session->set('shop',$this->store_name);

		$this->logger->notice('---->oauth is getting token');
		$shopSettings = $this->getDoctrine()
			->getManager()
			->getRepository('FgmsShopifyBundle:ShopifyShopSettings')
			->findOneBy(array('storeName'=>$this->store_name,'status'=>'active'));

		$session->set('token',$shopSettings->getAccessToken());

		$this->logger->notice('---->oauth session token '.$session->get('token'));
        $this->get_app_settings();
        $this->template_array['title'] ='Home';
        return $this->render('FgmsShopifyBundle:Default:home.html.twig', $this->template_array);
    }


    private function get_app_settings() {
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $this->get('logger');//$settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key'], 'enables'=>$settings['enables']);
		$this->logger->notice('settings: '. print_R($this->template_array,true));
    }


    // this function is what adds a new shop ... and gets access code.
    public function addAction(Request $request){
        $this->request = $request;
        $this->session = $request->getSession();

        $this->get_app_settings();
        //Step 3.  We have the code now
        if ($request->query->has('code')){
            $this->store_name = $request->query->get('shop');
            $this->logger->notice('** STEP 2. Getting token from Code for store: ' .$this->store_name.' with code: '. $request->query->get('code')) ;
            $this->shopify = new ShopifyClient($this->store_name, "", $this->api_key, $this->shared_secret,$this->logger);
            $this->session->clear();
            $access_token = $this->shopify->getAccessToken($request->query->get('code'));
            $this->logger->notice('Access token: '.$access_token);
            $this->session->set('token',$access_token) ;
            if ($access_token != ''){
				$em = $this->getDoctrine()->getManager();
				$shopSettings = $em->getRepository('FgmsShopifyBundle:ShopifyShopSettings')
					->findOneBy(array('storeName'=>$this->store_name,'status'=>'active'));

				if (!$shopSettings){
					$shopSettings = new ShopifyShopSettings();
					$shopSettings->setCreateDate();
					$shopSettings->setStoreName($this->store_name);
				}
				$shopSettings->setStatus('active');
				$shopSettings->setAccessToken($access_token);
				$em->persist($shopSettings);
				$em->flush();

                $this->session->set('shop',$this->store_name) ;
                $this->logger->notice('FGMS App Succesfully Added to '. $this->store_name);
            }
        }
        //STEP 1. This is the first step to authorization of Shopify App, load form / and get redirect url
        else {
            //create Form
            $form = $this->createFormBuilder(array('shop'=>'12metre.myshopify.com'),array('csrf_protection' => false))
                ->add('shop','text')
                ->add('save','submit',array('label'=>'Add App'))
                ->getForm();
            //check form request
            $form->handleRequest($request);
            if ($form->isValid()){
                $this->store_name = $form->getData()['shop'];
				$yaml = new Parser();
				$yaml = $yaml->parse(file_get_contents($this->get('kernel')->getRootDir().'/config/parameters.yml'));
				$params = $yaml['parameters'];
                // Step 1: get the shopname from the user and redirect the user to the
                // shopify authorization page where they can choose to authorize this app
                $shopifyClient = new ShopifyClient($this->store_name, "", $params['shopify_api_key'], $params['shopify_shared_secret'],$this->get('logger'));
                $pageURL = 'http';
                if ($this->request->server->get("HTTPS") == "on") 		{ $pageURL .= "s"; }
                $pageURL .= "://";

                if ($this->request->server->get("SERVER_PORT") != "80") {
                    $pageURL .= $this->request->server->get("SERVER_NAME") .
                    ":".
                    $this->request->server->get("SERVER_PORT") .
                    $this->request->server->get("REQUEST_URI");
                }
                else  {
                    $pageURL .= $this->request->server->get("SERVER_NAME").
                    $this->request->server->get("REQUEST_URI");
                }

                // redirect to authorize url
                $auth_url = $shopifyClient->getAuthorizeUrl($params['shopify_scope'], $params['shopify_redirect_url']);                
                return $this->redirect($auth_url);
            }
			else {
				// ok in case you are currently logged into app session shop will be enabled, need to remove.
				$this->session->clear();
			}
            return $this->render('FgmsShopifyBundle:Default:addApp.html.twig', array('form'=>$form->createView()));
        }
        return $this->render('FgmsShopifyBundle:Default:index.html.twig', array('name' => 'Success'));
    }
}