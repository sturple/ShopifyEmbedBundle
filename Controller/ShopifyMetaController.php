<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Form\MetaData;

class ShopifyMetaController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$store_name,
		$redirect_url,
		$template_array = array();   

	public function adminAction(Request $request){
		return $this->showAction($request->query->get('id'));
	}
	public function showAction($productId){     
		$this->get_app_settings();
		$this->template_array['productDetail'] = $this->shopify->call('GET','/admin/products/'.$productId.'.json');
		$this->template_array['metadata'] = $this->shopify->call('GET','/admin/products/'.$productId.'/metafields.json');
		$this->logger->notice('MetaData for '.$productId, $this->template_array['metadata']);
		$this->template_array['title'] ='Meta Data';
		$request = $this->get('request');
		if (intval($request->query->get('metaId',0))> 0){
			$m = $this->shopify->call('GET','/admin/metafields/'.$request->query->get('metaId',0).'.json');
			$form = $this->get_meta_form(array('metaNamespace'=>$m['namespace'],
											   'metaValueType'=>$m['value_type'],
											   'metaValue'=>$m['value'],
											   'metaKey'=>$m['key'],
											   'metaId'=>$m['id']));
		}
		else {
			$form = $this->get_meta_form();
		}
		

		$form->handleRequest($this->get('request'));

		if ($form->isValid()) {
			// data is an array with "name", "email", and "message" keys
			$data = $form->getData();
			$this->logger->notice('__________Data___',$data);
			//means a new entry
			
			$request->query->set('productId',$productId);
			if (intval($data['metaId']) == 0){
				
				$params = array('key'=>$data['metaKey'],
								'namespace'=>$data['metaNamespace'],
								'value'=>$data['metaValue'],
								'value_type'=>$data['metaValueType']);
				
				
			}
			//updating existing entry
			else {
				$request->query->set('action','update');
				$params = array('value'=>$data['metaValue'],
								'value_type'=>$data['metaValueType']);				
			}
			ShopifyClient::update_metadata($this->shopify, $request, $params);
			return $this->redirect('/shopify/meta/'.$productId.'/');
		}
		$this->template_array['metaEditId'] = intval($request->query->get('metaId',0));
		$this->template_array['form'] = $form->createView();
		return $this->render('FgmsShopifyBundle:ShopifyMeta:index.html.twig',$this->template_array); 		
	}
	
	
	public function deleteAction($productId, $id){
		$this->get_app_settings();
		$this->shopify->call('DELETE','/admin/metafields/' . $id . '.json');
		return $this->redirect('/shopify/meta/'. $productId);
	}
	
	public function updatemetaAction(Request $request){		
		$this->get_app_settings();
		$params = array('namespace'=>'FGMSMeta',
						'key'=>$request->query->get('key','defaultKey'),
						'value'=>ShopifyClient::clean_data($request->query->get('data','<div></div>')),
						'value_type'=>$request->query->get('type','string'));
		$output = ShopifyClient::update_metadata($this->shopify,$request, $params);
		$this->logger->notice('---------- Meta Data Update',$output);
		$this->logger->notice('REQUEST... ', $request->query->all());
		if ( ($request->query->get('action','create') == 'create') || ($request->query->get('action','create') == 'delete') ){
			return $this->redirect('/shopify/meta/'. $request->query->get('productId'));
		}		
		$response = new JsonResponse();
		$response->setData($output);		
	}	

	private function get_meta_form($defaultData=array()){
		$key_array = array();
		if (count($defaultData) == 0){
			$defaultData = array('metaNamespace'=>'FGMSMeta','metaValueType'=>'string','metaId'=>0);
			$metaList = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:MetaData')
			->findAll(array('name'=>'ASC'));
			foreach ($metaList as $item){
				$key_array[$item->getKey()] = $item->getName();
			}
			
		}
		

		$form = $this->createFormBuilder($defaultData)
		->add('metaId','hidden')
		->add('metaNamespace','hidden')
		->add('metaValueType','choice',array(
									'choices' => array('String'=>'string', 'Integer'=>'integer')
									)
		)
		
		->add('metaValue','textarea')	
		->add('save','submit',array('label'=>(count($key_array) > 0) ? 'Add':'Save'))			
		->getForm();
		if (count($key_array) > 0){
			$form->add('metaKey','choice',array(
										'choices' => $key_array
										)
			);			
		}
		else {
			$form->add('metaKey','hidden');
		}

		return $form;		
	}
	
    private function get_app_settings() {		
        $yaml = new Parser();        
        $yaml = $yaml->parse(file_get_contents($this->get('kernel')->getRootDir().'/config/parameters.yml'));
        $parameters = $yaml['parameters'];
        $this->shared_secret = $parameters['shopify_shared_secret'];
        $this->api_key = $parameters['shopify_api_key'];
        $this->scope = $parameters['shopify_scope'];
        $this->redirect_url = $parameters['shopify_redirect_url'];		
        $this->session = $this->get('request')->getSession();
		$this->store_name = $this->session->get('shop');
        $this->logger = $this->get('logger');
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$this->store_name, 'app_api'=>$this->api_key);			
		$this->shopify = new ShopifyClient($this->store_name,$this->session->get('token'),$this->api_key, $this->shared_secret,$this->logger);
    }	
}