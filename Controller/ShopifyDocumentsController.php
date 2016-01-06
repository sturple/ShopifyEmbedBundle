<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Entity\DocumentsMeta;
use \Fgms\ShopifyBundle\Form\DocumentsMetaType;

class ShopifyDocumentsController extends Controller {
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
        $this->template_array['title'] ='Documents';
		$this->template_array['products'] = $this->shopify->call('GET','/admin/products.json', array('limit'=>250));
		return $this->render('FgmsShopifyBundle:ShopifyTabs:index.html.twig', $this->template_array); 
	}
	
	public function adminAction(Request $request){
		return $this->showAction($request->query->get('id'));
	}
	
	
	
	public function deleteAction($productId, $id){
		$this->get_app_settings();
		$em = $this->getDoctrine()->getManager();
		$doc = $em->getRepository('FgmsShopifyBundle:DocumentsMeta')->find($id);
		$this->shopify->call('DELETE','/admin/themes/'.ShopifyClient::get_current_theme($this->shopify). '/asset[key]=assets/'.$doc->getAsset());
		$em->remove($doc);
		$em->flush();
		$this->set_documents_metadata($productId);
		return $this->redirect('/shopify/documents/'.$productId.'/');	
	}
	
	
	
	public function showAction($productId){		
		$this->get_app_settings();		
		$this->template_array['productDetail'] = $this->shopify->call('GET','/admin/products/'.$productId.'.json');
		$this->template_array['metadata'] = $this->shopify->call('GET','/admin/products/'.$productId.'/metafields.json');
		$docId = 0;
		$form = false;
		$documents = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:DocumentsMeta')
			->findBy(array('productId'=>$productId,'storeName'=>$this->store_name),array('tabOrder'=>'ASC'));
		$count = count($documents);
		foreach ($documents as $doc){
			if ($this->get('request')->query->get('id') == $doc->getId()){
				$form = $this->get_documents_form($doc);
				$docId = $doc->getId();
			}			
		}		
		if ($form === false ){
			$doc = new DocumentsMeta();		
			$doc->setProductId($productId);
			$doc->setUpdateDate(new \DateTime('now'));
			$doc->setStoreName($this->store_name);
			$doc->setTabOrder(++$count);
			if ($doc->getCreateDate() == null) {
				$doc->setCreateDate(new \DateTime('now'));
			}			
			$form = $this->get_documents_form($doc);
		}				
		
		
		$form->handleRequest($this->get('request'));
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			if (intval($form->getData()->getId()) == 0){
				$file = $form->getData()->getAsset();
				$theme = ShopifyClient::get_current_theme($this->shopify);
				$attachment = base64_encode(file_get_contents($file));
				$this->shopify->call('PUT','/admin/themes/'.$theme.'/assets.json',array('asset'=>array('key'=>"assets/".$file->getClientOriginalName(),'attachment'=>$attachment)));
				$form->getData()->setAsset($file->getClientOriginalName());
				$form->getData()->setImageBase64($attachment);				
			}

			$em->persist($form->getData());
			$em->flush();
			$this->set_documents_metadata($productId);
			return $this->redirect('/shopify/documents/'.$productId.'/');			
		}
		$this->template_array['form'] = $form->createView();
		$this->template_array['title'] ='Documents' ;
		$this->template_array['docid'] =$docId;
		$this->template_array['documents'] =$documents;
		return $this->render('FgmsShopifyBundle:ShopifyDocuments:index.html.twig',$this->template_array); 		
	}


	
	private function get_documents_form($doc){
		$this->logger->notice('get document form::: id '.intval($doc->getId()));
		if (intval($doc->getId()) == 0){
			$form = $this->createFormBuilder($doc, array('csrf_protection' => true))		
				->add('title')		
				->add('tabOrder')
				->add('productId', 'hidden')		
				->add('save','submit',array('label'=>'Add'))
				->add('asset','file')
				->getForm();			
		}
		else {
			$form = $this->createFormBuilder($doc, array('csrf_protection' => true))		
				->add('title')		
				->add('tabOrder')
				->add('productId', 'hidden')		
				->add('save','submit',array('label'=>'Save'))
				->getForm();			
		}
		
		
		return 	$form;
	}

	
	public function updatemetaAction(Request $request){		
		$this->get_app_settings();
		$params = array('namespace'=>'FGMS',
						'key'=>'documents',
						'value'=>ShopifyClient::clean_data($request->query->get('data'," -- default -- ")),
						'value_type'=>'string');
		$output = ShopifyClient::update_metadata($this->shopify,$request, $params);
		$this->set_documents_metadata($request->query->get('productId'));				
		return $this->redirect('/shopify/documents/'. $request->query->get('productId'));		
		$response = new JsonResponse();
		return $response->setData($output);		
	
	}
	
	/*
	 * This sets the meta data tab to match whats in the database
	 */
	private function set_documents_metadata($productId){
		$docs = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:DocumentsMeta')
			->findBy(array('productId'=>$productId,'storeName'=>$this->store_name),array('tabOrder'=>'ASC'));
		$output_array = array();
		foreach ($docs as $item ){
			$str = $item->getTitle() . ' || ' . $item->getAsset() ;			
			$output_array[] = $str;
		}
		$metaData = $this->shopify->call('GET','/admin/products/'.$productId.'/metafields.json');
		$metaId = 0;
		foreach ($metaData as $meta){
			if (($meta['namespace'] == 'FGMS') && ($meta['key']== 'documents') ) {
				$metaId = $meta['id'];
				break;
			}
		}
		$request = $this->get('request');	
		$request->query->set('action',(($metaId == 0 ) ? 'create' : 'update'));		
		$request->query->set('productId',$productId);
		$request->query->set('metaId',$metaId);		
		$params = array('value'=>ShopifyClient::clean_data(implode('%%',$output_array)));
		if ($metaId == 0 ) {
			$params = array_merge($params,array('key'=>'documents','value_type'=>'string','namespace'=>'FGMS'));
		}
		ShopifyClient::update_metadata($this->shopify, $request, $params);
		//ShopifyClient::update_metadata($this->shopify, $request, $params);
	}
	
	
    private function get_app_settings() {		
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);	
		

    }
	
}