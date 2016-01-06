<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Entity\OptionsMeta;
use \Fgms\ShopifyBundle\Form\OptionsMetaType;

class ShopifyOptionsController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$store_name,
		$redirect_url,
		$template_array = array();    
   
    public function indexAction(){
        //$this->request = $request;
		$this->get_app_settings();		
        $this->template_array['title'] ='Product Options';
		$this->template_array['products'] = $this->shopify->call('GET','/admin/products.json', array('limit'=>250));
		return $this->render('FgmsShopifyBundle:ShopifyOptions:index.html.twig', $this->template_array); 
	}
	
	public function adminAction(Request $request){
		return $this->showAction($request->query->get('id'));
	}
	
	
	
	public function deleteAction($productId, $id){
		$this->get_app_settings();
		$em = $this->getDoctrine()->getManager();
		$optionsMeta = $em->getRepository('FgmsShopifyBundle:OptionsMeta')->find($id);
		$em->remove($optionsMeta);
		$em->flush();
		$this->set_options_metadata($productId);
		return $this->redirect('/shopify/options/'. $productId.'/');
		
	}
	
	
	
	public function showAction($productId){		
		$this->get_app_settings();
		//$this->logger->notice('Product Page REQUEST::',$this->get('request')->query->all());
		$this->template_array['productDetail'] = $this->shopify->call('GET','/admin/products/'.$productId.'.json');
		$this->template_array['metadata'] = $this->shopify->call('GET','/admin/products/'.$productId.'/metafields.json');
		//$this->logger->notice('MetaData for '.$productId, $this->template_array['metadata']);

		$options = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:OptionsMeta')
			->findBy(array('productId'=>$productId),array('optionOrder'=>'ASC'));
		$count = count($options);
		$form = false;
		$formId = 0;
		foreach ($options as $option){
			if ($this->get('request')->query->get('id') == $option->getId()){
				$form = $this->get_options_form($option);
				$formId = $option->getId();
			}			
		}		
		if ($form === false ){
			$date = new \DateTime('now');
			$optionsMeta = new OptionsMeta();		
			$optionsMeta->setProductId($productId);
			$optionsMeta->setShop($this->store_name);
			$optionsMeta->setOptionOrder(++$count);
			if ($optionsMeta->getCreateDate() == null) {
				$optionsMeta->setCreateDate($date);
			}
			$optionsMeta->setPublishOn($date);
			$optionsMeta->setPublishOff($date->add(new \DateInterval('P10Y')));
			$form = $this->get_options_form($optionsMeta);
		}		
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			$this->set_options_metadata($productId);
			return $this->redirect('/shopify/options/'.$productId.'/');
		}
		$this->template_array['form'] = $form->createView();
		$this->template_array['formid'] =$formId;
		$this->template_array['title'] ='Product Options';
		$this->template_array['options'] =$options;		
		return $this->render('FgmsShopifyBundle:ShopifyOptions:index.html.twig',$this->template_array); 		
	}
	/*
	 * This sets the meta data tab to match whats in the database
	 */
	private function set_options_metadata($productId){
		$options = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:OptionsMeta')
			->findBy(array('productId'=>$productId),array('optionOrder'=>'ASC'));
		$output_array = array();
		foreach ($options as $option ){
			$output_array[] = $option->getOptionId(). '||' . $option->getOptionType() .'||'. $option->getOptionEnable(). '||' .$option->getPublishOn()->getTimestamp() . '||'. $option->getPublishOff()->getTimestamp()   ;
		}
		$metaData = $this->shopify->call('GET','/admin/products/'.$productId.'/metafields.json');
		$metaId = 0;
		//$this->logger->notice('Metadata '.print_R($metaData,true));
		foreach ($metaData as $meta){
			if (($meta['namespace'] == 'FGMS') && ($meta['key']== 'options') ) {
				$metaId = $meta['id'];
				break;
			}
		}
		$str_data =  implode('%%',$output_array);
		$request = $this->get('request');
		$request->query->set('action',($metaId == 0 ? 'create':'update'));
	
		$request->query->set('metaId',$metaId);
		$request->query->set('productId',$productId);
		$this->logger->notice('option str ' .' metaid ' . $metaId . ' '.$str_data);
		$params = array('value'=>(ShopifyClient::clean_data($str_data)));
		if ($metaId == 0){
			$params['namespace'] = 'FGMS';
			$params['key'] = 'options';
			$params['value_type'] = 'string';
		}	
		$this->logger->notice('___________________' . print_R(ShopifyClient::update_metadata($this->shopify, $request, $params),true));
	}
	
	
	private function get_options_form($optionsMeta){
		$product_choice = ShopifyClient::get_products($this->shopify,$this->logger);

		$form = $this->createFormBuilder($optionsMeta, array('csrf_protection' => true))
	
		->add('optionDescription','hidden')
		->add('optionEnable')
		->add('optionOrder','number')
		->add('optionId','choice', array(
									'choices'=>$product_choice,
									'required'=>true,
									'placeholder' => '-- Select Product -- '
									
									)
		)		
		->add('optionType',
			  'choice',
			  array(
					'choices' => array(  'radio'=>'Radio Style', 'engrave'=>'Engrave Option','checkbox-with-image'=>'Check Box With Side Image', 'select'=>'Select Dropdown')
				)
		)
		->add('publishOn','date')
		->add('publishOff','date')

		->add('save','submit',array('label'=>(intval($optionsMeta->getId()) == 0)? 'Add': 'Save'))			
		->getForm();
		return $form;		
	}

	
	public function updatemetaAction(Request $request){		
		$this->get_app_settings();
		$params = array('namespace'=>'FGMS',
						'key'=>'tab',
						'value'=>ShopifyClient::clean_data($request->query->get('data'," -- default -- ")),
						'value_type'=>'string');

		$output = ShopifyClient::update_metadata($this->shopify,$request, $params);


		
		$this->set_tab_metadata($request->query->get('productId'));
		
				
		return $this->redirect('/shopify/options/'. $request->query->get('productId'));
		
		
		$response = new JsonResponse();
		return $response->setData($output);
		
	
	}
	

	
	
    private function get_app_settings() {		
 		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);	
		

    }
	
}