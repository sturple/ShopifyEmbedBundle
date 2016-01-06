<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Entity\ContactRequest;
use \Fgms\ShopifyBundle\Entity\FormSettings;
use \Fgms\ShopifyBundle\Form\FormSettingsType;

class ShopifyFormsController extends Controller {
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
		$this->get_app_settings();
		$settings = $this->getDoctrine()
			->getManager()
			->getRepository('FgmsShopifyBundle:FormSettings')
			->findOneBy(array('shop'=>$this->store_name));
		// settings hasn't been setup yet lets create default settings.
		if (! $settings){
			$settings = new FormSettings();
			$settings->setShop($this->store_name);
			$settings->setUpdateDate();
			
		}
		$form = $this->createForm(new FormSettingsType(),$settings);
		$form->handleRequest($this->get('request'));
		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();					
		}
		$this->template_array['fs'] = $settings;
		$this->template_array['form'] = $form->createView();
 		$this->template_array['title'] ='Form / Email Settings';
		$this->template_array['formMenu'] ='setup';
		return $this->render('FgmsShopifyBundle:ShopifyForms:form-setup.html.twig',$this->template_array); 		
	}
	
	public function setupAction($formType){
		$this->get_app_settings();		
		$this->template_array['title'] ='Setup ' .$formType .' Form';
		$this->template_array['formMenu'] ='setup';
		return $this->render('FgmsShopifyBundle:ShopifyForms:index.html.twig',$this->template_array); 			
	}
	
	public function communicationsAction(){
		$this->get_app_settings();		
		$this->template_array['title'] ='Website Communications';
		$this->template_array['formMenu'] ='communications';
		return $this->render('FgmsShopifyBundle:ShopifyForms:index.html.twig',$this->template_array); 			
	}
	
	public function rmaIndexAction(Request $request){
		$this->get_app_settings();	
		
		$query =$this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Rma')
			->createQueryBuilder('rma')
			->where("rma.storeName = '". $this->store_name."'" )
			->orderBy('rma.createDate')
			->getQuery();
		$rmaIndex= $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		
		
		// lets now add the rmaitems
		foreach ($rmaIndex as &$rmaitem){
			
			$rmaItemQuery =$this->getDoctrine()
				->getRepository('FgmsShopifyBundle:RmaItem')
				->createQueryBuilder('rmaitem')
				->where("rmaitem.session = '". $rmaitem['session']."' AND rmaitem.status = 'active'")
				->orderBy('rmaitem.createDate')
				->getQuery();			
			
			$rmaitem['rmaitems'] = $rmaItemQuery->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
			$this->logger->notice('rmaitems .....' .print_R($rmaitem['rmaitems'],true));
		}
		$this->logger->notice('Index '. print_R($rmaitem,true));
		$statusOptions = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:RmaStatus')
			->findBy(array('status'=>'active'), array('sortOrder'=>'ASC'));
		
		$this->template_array['title'] ='Product Returns';
		$this->template_array['formMenu'] ='rma';
		$this->template_array['formIndex'] = $rmaIndex;
		$this->template_array['statusOptions'] = $statusOptions;
		return $this->render('FgmsShopifyBundle:ShopifyForms:rma-index.html.twig',$this->template_array); 			
	}	
	public function rmaDetailAction($rmaNumber){
		$this->get_app_settings();		
		$this->template_array['title'] ="RMA ({$rmaNumber})";
		$this->template_array['formMenu'] ='rma';
		
		return $this->render('FgmsShopifyBundle:ShopifyForms:rma-index.html.twig',$this->template_array); 			
	} 
    

    private function get_app_settings() {		
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);	
    }	
}