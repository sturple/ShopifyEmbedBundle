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
			->getRepository('FgmsShopifyBundle:Customers')
			->createQueryBuilder('rma')
			->where("rma.storeName = '". $this->store_name."' and rma.transaction = 'rma'"  )
			->orderBy('rma.createDate','DESC')
			->getQuery();
		$rmaIndex= $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		// lets now add the rmaitems
		foreach ($rmaIndex as &$item){
			$itemQuery =$this->getDoctrine()
				->getRepository('FgmsShopifyBundle:RmaItem')
				->createQueryBuilder('item')

				->where("item.session = '". $item['session']."' AND item.status = 'active'")
				->orderBy('item.createDate')
				->getQuery();
			$item['items'] = $itemQuery->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
/*
            $form = $this->createFormBuilder($item)
                ->add('status','entity',array('class'=>'FgmsShopifyBundle:RmaStatus',
                                                'choice_label'=>'name',
                                                'choice_attr'=>array('class'=>''),
                                                'data'=>$item['status'],
                                                'label_attr'=>array('class'=>'hidden'),
                                                'attr'=>array('style'=>'padding: 0px; font-size: 11px;')))
                ->getForm();
            $item['form']  =  $form->createView();*/

            /*if ($form !== false){
    			$form->handleRequest($this->get('request'));
    			if ($form->isValid()){
    				$em = $this->getDoctrine()->getManager();
    				$em->persist($form->getData());
    				$em->flush();
                }
            }*/
		}

		$this->template_array['title'] ='Product Returns';
		$this->template_array['formMenu'] ='rma';
		$this->template_array['formIndex'] = $rmaIndex;
		return $this->render('FgmsShopifyBundle:ShopifyForms:product-index.html.twig',$this->template_array);
	}
    public function warrantyIndexAction(Request $request){
		$this->get_app_settings();
		$query =$this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Customers')
			->createQueryBuilder('warranty')
			->where("warranty.storeName = '". $this->store_name."' and warranty.transaction = 'warranty'"  )
			->orderBy('warranty.createDate','DESC')
			->getQuery();
		$warrantyIndex= $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

		// lets now add the rmaitems
		foreach ($warrantyIndex as &$item){
			$itemQuery =$this->getDoctrine()
				->getRepository('FgmsShopifyBundle:WarrantyItem')
				->createQueryBuilder('item')
				->where("item.session = '". $item['session']."' AND item.status = 'active'")
				->orderBy('item.createDate')
				->getQuery();
			$item['items'] = $itemQuery->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        }
		$statusOptions = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:RmaStatus')
			->findBy(array('status'=>'active'), array('sortOrder'=>'ASC'));
		$this->template_array['title'] ='Product Warranty';
		$this->template_array['formMenu'] ='warranty';
		$this->template_array['formIndex'] = $warrantyIndex;
		$this->template_array['statusOptions'] = $statusOptions;
		return $this->render('FgmsShopifyBundle:ShopifyForms:product-index.html.twig',$this->template_array);
	}

	public function rmaDetailAction($rmaNumber){
		$this->get_app_settings();
		$this->template_array['title'] ="RMA ({$rmaNumber})";
		$this->template_array['formMenu'] ='rma';
		return $this->render('FgmsShopifyBundle:ShopifyForms:rma-index.html.twig',$this->template_array);
	}

    public function updateFormAction(){

    }

    private function get_app_settings() {
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);
    }
}
