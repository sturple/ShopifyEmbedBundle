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


class ShopifySpecialsController extends Controller {
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
		$this->template_array['title'] ='Specials ';
		$specials = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Specials')
			->findBy(array('status'=>'active','shop'=>$this->store_name),array('id'=>'ASC'));
		$this->template_array['specials'] = $specials;
		
		return $this->render('FgmsShopifyBundle:ShopifySpecials:index.html.twig',$this->template_array); 			
	}
	

	
	public function editAction($id){
		$id = intval($id);
		$this->get_app_settings();	
		$specials = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Specials')
			->findOneBy(array('id'=>$id),array('id'=>'ASC'));
		// create a new one if not exists
		if (!$specials){
			$specials = new Specials();
			$specials->setCreateDate();
			$specials->setShop($this->store_name);
			
		}
		$this->template_array['title'] ='Specials: ' .$specials->getTitle();
		$this->template_array['specials'] = $specials;
		$form = $this->createForm(new SpecialsType(),$specials);
		
		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){	
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
			if ($specials->getId() > 0){
				return $this->redirect('/shopify/specials/'.$specials->getId());
			}
			
		}
		$this->template_array['form'] = $form->createView();
		$this->template_array['special'] = $specials;
			
		return $this->render('FgmsShopifyBundle:ShopifySpecials:form.html.twig',$this->template_array);			
		
	}	
	
	public function publicAction($permalink){		
		$this->get_app_settings();
		$this->template_array['title'] ='Specials ';	
	/*	
		$specials = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Specials')
			->findOneBy(array('permalink'=>$permalink),array('id'=>'ASC'));
	*/		
		$em = $this->getDoctrine()->getManager();		
		$query = $em->createQuery("
			SELECT s
			FROM FgmsShopifyBundle:Specials s
			WHERE s.status = 'active' AND s.shop = :shop AND s.publishDate < CURRENT_TIMESTAMP() AND s.unpublishDate > CURRENT_TIMESTAMP() AND s.permalink = :permalink
			
			")
		->setParameter('shop',$this->store_name)
		->setParameter('permalink',$permalink);		
		$specials = $query->getOneOrNullResult();			
	
		if (!$specials){
			return $this->redirect('../');
		}
	
		$this->template_array['special'] = $specials;

		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifySpecials:public.html.twig',$this->template_array);	
	}
	
	public function publicindexAction(){		
		$this->get_app_settings();
		$this->template_array['title'] ='Specials ';	
		
		$em = $this->getDoctrine()->getManager();		
		$query = $em->createQuery("
			SELECT s
			FROM FgmsShopifyBundle:Specials s
			WHERE s.status = 'active' AND s.shop = :shop AND s.publishDate < CURRENT_TIMESTAMP() AND s.unpublishDate > CURRENT_TIMESTAMP()
			")
		->setParameter('shop',$this->store_name);		
		$specials = $query->getResult();
		/*
	
		$specials = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Specials')
			->findBy(array('status'=>'active','shop'=>$this->store_name),array('id'=>'ASC'));
			
		*/			
		$this->template_array['specials'] = $specials;

		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifySpecials:publicindex.html.twig',$this->template_array);	
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