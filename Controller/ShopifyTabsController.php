<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Entity\TabsMeta;
use \Fgms\ShopifyBundle\Form\TabsMetaType;

class ShopifyTabsController extends Controller {
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
        $this->template_array['title'] ='Tabs';
		$this->template_array['products'] = $this->shopify->call('GET','/admin/products.json', array('limit'=>250));
		return $this->render('FgmsShopifyBundle:ShopifyTabs:index.html.twig', $this->template_array); 
	}
	
	public function adminAction(Request $request){
		return $this->showAction($request->query->get('id'));
	}
	
	
	
	public function deleteAction($productId, $id){
		$this->get_app_settings();
		$em = $this->getDoctrine()->getManager();
		$tabmeta = $em->getRepository('FgmsShopifyBundle:TabsMeta')->find($id);
		$em->remove($tabmeta);
		$em->flush();
		$this->set_tab_metadata($productId);
		return $this->redirect('/shopify/tabs/'. $productId.'/');
		
	}
	
	
	
	public function showAction($productId){		
		$this->get_app_settings();
		//$this->logger->notice('Product Page REQUEST::',$this->get('request')->query->all());
		$this->template_array['productDetail'] = $this->shopify->call('GET','/admin/products/'.$productId.'.json');
		$this->template_array['metadata'] = $this->shopify->call('GET','/admin/products/'.$productId.'/metafields.json');
		//$this->logger->notice('MetaData for '.$productId, $this->template_array['metadata']);

		$tabs = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:TabsMeta')
			->findBy(array('productId'=>$productId),array('tabOrder'=>'ASC'));
		$count = count($tabs);
		$form = false;
		$formId = 0;
		foreach ($tabs as $tab){
			if ($this->get('request')->query->get('id') == $tab->getId()){
				$form = $this->get_tab_form($tab);
				$formId = $tab->getId();
			}			
		}		
		if ($form === false ){
			$tabmeta = new TabsMeta();		
			$tabmeta->setProductId($productId);
			$tabmeta->setTabOrder(++$count);
			$tabmeta->setUpdateDate(new \DateTime('now'));
			if ($tabmeta->getCreateDate() == null) {
				$tabmeta->setCreateDate(new \DateTime('now'));
			}			
			$form = $this->get_tab_form($tabmeta);
		}		
		$form->handleRequest($this->get('request'));
		$this->logger->notice('***** form data '. $productId .' ' . print_R($_REQUEST,true));
		if ($form->isValid()){			
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			$this->set_tab_metadata($productId);
			return $this->redirect('/shopify/tabs/'.$productId.'/');
		}
		$this->template_array['form'] = $form->createView();
		$this->template_array['formid'] =$formId;
		$this->template_array['title'] ='Tabs';
		$this->template_array['tabs'] =$tabs;		
		return $this->render('FgmsShopifyBundle:ShopifyTabs:index.html.twig',$this->template_array); 		
	}
	/*
	 * This sets the meta data tab to match whats in the database
	 */
	private function set_tab_metadata($productId){
		$tabs = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:TabsMeta')
			->findBy(array('productId'=>$productId),array('tabOrder'=>'ASC'));
		$output_array = array();
		
		foreach ($tabs as $tab ){
			$str = $tab->getTitle() . ' || ' . $tab->getType() ;
			if (strtolower($tab->getType()) == 'snippet'){
				$str .= ' || ' . strtolower($tab->getSnippet());
			} else if (strtolower($tab->getType()) == 'html'){
				$str .= ' || ' . strtolower($tab->getHtml());
			}
			$output_array[] = $str;
		}
		if (count($output_array) > 0){
			$metaData = $this->shopify->call('GET','/admin/products/'.$productId.'/metafields.json');
			$metaId = 0;
			//$this->logger->notice('Metadata '.print_R($metaData,true));
			foreach ($metaData as $meta){
				if (($meta['namespace'] == 'FGMS') && ($meta['key']== 'tab') ) {
					$metaId = $meta['id'];
					break;
				}
			}
			
			$request = $this->get('request');
			$request->query->set('action','update');
			$request->query->set('metaId',$metaId);		
			$params = array('value'=>ShopifyClient::clean_data(implode('%%',$output_array)));
			//$this->logger->notice('--33333333------- '.print_R($params,true). ' output array ' .print_R($output_array,true). ' metaid ' . $metaId);
			ShopifyClient::update_metadata($this->shopify, $request, $params);			
		}

	}
	
	
	private function get_tab_form($tabsMeta){
		$snippet_raw = ShopifyClient::get_assets($this->shopify);
		$snippet_choice = array();
		foreach ($snippet_raw as $snippet){
			$snippet_choice[$snippet] = $snippet;
		}
		$form = $this->createFormBuilder($tabsMeta, array('csrf_protection' => true))
		->add('productId','hidden')
		->add('title','text')
		->add('type','choice', array(
									'choices' => array('html'=>'HTML', 'snippet'=>'Snippet','content'=>'Content','documents'=>'Documents')
									)
		)
		->add('snippet','choice', array(
									'choices'=>array_merge(array(''),$snippet_choice),
									'required'=>false,
									
									)
		)
		->add('html','textarea', array('required'=>false))
		->add('tabOrder','number')
		->add('save','submit',array('label'=>(intval($tabsMeta->getId()) == 0)? 'Add': 'Save'))			
		->getForm();
		return $form;		
	}

	
	public function updatemetaAction(Request $request){		
		$this->get_app_settings();
		$params = array('namespace'=>'FGMS',
						'key'=>'tab',
						'value'=>ShopifyClient::clean_data($request->query->get('data',"Overview || content")),
						'value_type'=>'string');
		//$this->logger->notice('****324*********** '.print_R($params,true));		
		$output = ShopifyClient::update_metadata($this->shopify,$request, $params);
		//$this->logger->notice('**************** '.print_R($output,true));

		
		$this->set_tab_metadata($request->query->get('productId'));		
				
		return $this->redirect('/shopify/tabs/'. $request->query->get('productId'));
		
		
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