<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;

use \Fgms\ShopifyBundle\Entity\ContactRequest;
use \Fgms\ShopifyBundle\Entity\ContactOnline;
use \Fgms\ShopifyBundle\Entity\Rma;
use \Fgms\ShopifyBundle\Entity\Customers;
use \Fgms\ShopifyBundle\Entity\RmaItem;
use \Fgms\ShopifyBundle\Entity\WarrantyItem;
use \Fgms\ShopifyBundle\Form\WarrantyType;
use \Fgms\ShopifyBundle\Form\RmaType;
use \Fgms\ShopifyBundle\Form\RmaItemType;


class ShopifyProxyController extends Controller {
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

	public function indexAction(Request $request){
		$this->get_app_settings();
		$this->template_array['title'] ='Proxy';
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyProxy:index.html.twig',$this->template_array);
	}


	public function snippetAction($snippet){
		$this->get_app_settings();
		$this->template_array['title'] ='Proxy Snippet ' . $snippet;
		return $this->render('FgmsShopifyBundle:ShopifyProxy:index.html.twig',$this->template_array);
	}


	public function renderAction($formType){
		$this->get_app_settings();
		$title = 'Online Inquiry';
		$subtitle = '';
		$form = false;
		switch(strtolower($formType)){
			case 'online' :
				$form = $this->get_form_online();
				break;
			case 'compact' :
				$form = $this->get_form_compact();
				break;
			case 'rma' :
				if ( $this->get('request')->query->get('status','') == 'submit'){
					$rma = $this->getDoctrine()
						->getRepository('FgmsShopifyBundle:Customers')
						->findOneBy(array('storeName'=>$this->store_name,'session'=>$this->get('request')->get('session')));
					if ($rma){
						$rma->setStatus('Submitted');
						$this->getDoctrine()->getManager()->flush();
                        //$this->sendEmailMessage('rma',$rma);
						return $this->redirect('../../form/rmaitem/?session='.$this->get('request')->query->get('session'));
					}

				}
				$form = $this->get_form_product('rma');
				$title = 'Return Merchandise Authorization';
				$subtitle ='Part 1/2: Your Contact Details';
				break;
            case 'warranty':
                if ( $this->get('request')->query->get('status','') == 'submit'){
                    $rma = $this->getDoctrine()
                        ->getRepository('FgmsShopifyBundle:Customers')
                        ->findOneBy(array('storeName'=>$this->store_name,'session'=>$this->get('request')->get('session')));
                    if ($rma){
                        $rma->setStatus('Submitted');
                        $this->getDoctrine()->getManager()->flush();
                        //$this->sendEmailMessage('warranty',$rma);
                        return $this->redirect('../../form/warrantyitem/?session='.$this->get('request')->query->get('session'));
                    }


                }
                $form = $this->get_form_product('warranty');
                $title = 'Product Warranty Registration';
                $subtitle ='Part 1/2: Your Contact Details';
                break;
			case 'rmaitem':
				if ( $this->get('request')->query->get('action','') == 'delete'){
					$rmaItem = $this->getDoctrine()
						->getRepository('FgmsShopifyBundle:RmaItem')
						->findOneBy(array('id'=>intval($this->get('request')->get('item')),'session'=>$this->get('request')->get('session')));
					if ($rmaItem) {
						$rmaItem->setStatus('delete');
						$this->getDoctrine()->getManager()->flush();
					}
					return $this->redirect('../../form/rmaitem/?session='.$this->get('request')->query->get('session'));
				}
				$form = $this->get_form_item('RmaItem');
				$title = 'RMA Item';
				break;
                case 'warrantyitem':
    				if ( $this->get('request')->query->get('action','') == 'delete'){
    					$rmaItem = $this->getDoctrine()
    						->getRepository('FgmsShopifyBundle:WarrantyItem')
    						->findOneBy(array('id'=>intval($this->get('request')->get('item')),'session'=>$this->get('request')->get('session')));
    					if ($rmaItem) {
    						$rmaItem->setStatus('delete');
    						$this->getDoctrine()->getManager()->flush();
    					}
    					return $this->redirect('../../form/warrantyitem/?session='.$this->get('request')->query->get('session'));
    				}
    				$form = $this->get_form_item('WarrantyItem');
    				$title = 'Warranty Item';
    				break;
			default:
				//$form = $this->get_form_online();
                return $this->redirect('/404');
				break;

		}

		if ($form !== false){
			$form->handleRequest($this->get('request'));
			if ($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				$em->persist($form->getData());
				$em->flush();

				if (($formType == 'rma' ) OR ($formType == 'rmaitem') OR ($formType == 'warranty') OR ($formType == 'warrantyitem') ){
                    // this is suppose to submit using shopify form interface. Not sure i need this anymore.
                    /*
					$postData = array('form_type'=>'contact',
									  'utf8'=>"\u2713",
									  "contact[First Name]"=>"Symfony Test",
									  "contact[type]"=>"Rma",
									  "contact[email]"=>"shawn@turple.ca",
									  "contact[Status]"=>"my status");

					$options = array(
						'CURLOPT_RETURNTRANSFER' => true,
						'CURLOPT_CUSTOMREQUEST'=>"POST",
						'CURLOPT_CONNECTTIMEOUT'=>'60',
						'CURLOPT_TIMEOUT'=>'60',
						'CURLOPT_POST'=>1,
						'CURLOPT_VERBOSE'=>1,
						'CURLOPT_POSTFIELDS'=>$postData
					);
					$this->get('anchovy.curl')->setURL('http://'.$this->store_name.'/contact?'.http_build_query($postData,'&'))->setOptions($options)->execute();
                    */
                    $redirectForm = (($formType == 'rma' ) OR ($formType == 'rmaitem')) ? 'rmaitem' : 'warrantyitem';
					return $this->redirect('../../form/' . $redirectForm . '/?session='.$form->getData()->getSession());
				}

				if ($form->getData()->getReturnUrl()){return $this->redirect($form->getData()->getReturnUrl());	}
			}
			$this->template_array['form'] = $form->createView();
		}

		$this->template_array['title'] = $title;
		$this->template_array['subtitle'] = $subtitle;
		if ($formType == 'rmaitem'){
			return $this->getItems('RmaItem');
		}
        else if ($formType == 'warrantyitem'){
            return $this->getItems('WarrantyItem');
        }

		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyProxy:index.html.twig',$this->template_array);


	}




	private function sendEmailMessage(){

        $data = array_merge($this->template_array,
                            array(  'global'=>$globals,
                                    'email'=> array(
                                        'introtext'=>'',
                                        'content'=>''
                                    ),
                                    'fields'=>array(),
                                    'store'=>$storeDetails
                                    )
                            );

        $this->get('fgms.mailer')->sendEmail(array( 'to'=>array('webmaster@fifthgeardev.com'),
                                                    'subject'=>'Registration | ' . $storeDetails['name'],
                                                    'html'=>$this->renderView('FgmsShopifyBundle:Emails:Registration-email.html.twig',$data),
                                                    'txt'=>$this->renderView('FgmsShopifyBundle:Emails:Registration-email.txt.twig',$data)
                                                ));

	}

	private function getItems($entity="RmaItem"){
		$session = $this->get('request')->query->get('session');
		$this->template_array['focusitem'] = ($this->get('request')->query->has('item')) ? $this->get('request')->query->get('item') : 0;
		$customer = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Customers')
			->findOneBy(array('session'=>$session));

		$items = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:'.$entity)
			->findBy(array('session'=>$session,'status'=>'active'));

		$this->template_array['customer'] = $customer;
		$this->template_array['items'] = $items;
		$this->template_array['title'] = ($entity == 'RmaItem') ? 'Return Merchandise Authorization' : 'Product Warranty Registration' ;
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyProxy:product.html.twig',$this->template_array);
	}



	public function rmaDeleteToolAction($rmaSession, $rmaTool){
		//$this->get_app_settings();
		//$this->template_array['title'] =" DELETE RMA ({$rmaSession}) Tool ({$rmaTool})";
		return $this->redirect('/'. $rmaSession.'/');
	}


	private function get_form_online(){
		$online = new ContactOnline();
		$online->setIp($this->get('request')->server->get('HTTP_X_REAL_IP'));
		if ($online->getCreateDate() == null){
			$online->setCreateDate();
		}
		$online->setFormType('Online');
		$online->setReturnUrl('/pages/contact');
		$form = $this->createFormBuilder($online,array('csrf_protection' => false))
            ->add('firstName', null, array('label'=>'First Name'))
            ->add('lastName', null, array('label'=>'Last Name'))
            ->add('address1', null,array('label'=>'Address','required'=>false))
          
            ->add('city')
            ->add('province')
            ->add('postal')
            ->add('country')
			->add('email')
            ->add('message')            
            ->add('listA',null, array('label'=>'Subscribe to email list','required'=>false))
			->add('save','submit',array('label'=>'Submit Inquiry'))
			->getForm();
		return $form;
	}

	private function get_form_compact(){
		return false;
	}

    /**
    * @param $type String {rma | warranty}
    */
	private function get_form_product($type="rma"){
		date_default_timezone_set('UTC');
		$customer = false;
		if ($this->get('request')->query->has('session')){
			$customer = $this->getDoctrine()
				->getRepository('FgmsShopifyBundle:Customers')
				->findOneBy(array('session'=>$this->get('request')->query->get('session')));
		}
		if (! $customer) {
			$customer = new Customers();
			$customer->setIp($this->get('request')->server->get('HTTP_X_REAL_IP'));
			if ($customer->getCreateDate() == null){
				$customer->setCreateDate();
			}
			if ($customer->getStatus() == null){
				$customer->setStatus('Created');
			}
			if ($customer->getSession() == null){
				$customer->setSession(md5($customer->getIp(). date('U')));
			}

            $customer->setTransaction($type);
			$customer->setStoreName($this->store_name);

		}

        if ($type == 'rma'){
            $form = $this->createForm(new RmaType(),$customer);
        }
        else {
            if ($customer->getPurchaseDate() == null){
                $customer->setPurchaseDate(new \DateTime("now"));
            }
            $form = $this->createForm(new WarrantyType(),$customer);
        }

		return $form;
	}

	private function get_form_item($entity="RmaItem"){
		$session = $this->get('request')->query->get('session');
        // Checks database to see if there is any existing { rma | warranty } items

        // Gets Product List Shopify API
		$products = $this->shopify->call('GET','/admin/products.json?fields=id,title,',array('limit'=>250));
		$product_select_array = array(''=>'-- Select Product --');
		foreach ($products as $val){
			if (array_key_exists('title',$val)){
				$title = $val['title'];
				$product_select_array[$title] = $title;
			}
		}

		$item = $this->getDoctrine()
			->getManager()
			->getRepository('FgmsShopifyBundle:'.$entity)
			->findOneBy(array('session'=>$this->get('request')->query->get('session'),'status'=>'active','id'=>$this->get('request')->query->get('item')));

        // check to see if exists otherwise create one.
        if (!$item){
            // warranty
            if ($entity == 'WarrantyItem'){
                $item = new WarrantyItem();
            }
            // RmaItem
            else {
                $item = new RmaItem();
            }
            if ($item->getCreateDate() == null){	$item->setCreateDate();}
			if ($item->getStatus() == null){	$item->setStatus('active');	}
			$item->setSession($session);
            $form = $this->createFormBuilder($item, array('csrf_protection' => false))
				->add('session', 'hidden') ;
        }
        else {
         $form = $this->createFormBuilder($item, array('csrf_protection' => false));
        }
        if ($entity == 'WarrantyItem'){
            $form = $form->add('quantity','integer', array('required'=>false,'label'=>'Quantity', 'attr'=>array('min'=>1)));
        }
        else {
            $form = $form->add('productImageFile','file',array('label'=>'Upload', 'required'=>false));
        }

        $form = $form
            ->add('session', 'hidden')
            ->add('product', 'choice',array('choices'=>$product_select_array,'required'=>false))
            ->add('productType',null, array('required'=>false,'label'=>'Tool'))
            ->add('productBrand',null, array('required'=>false,'label'=>'Brand'))
            ->add('productNotes',null, array('required'=>false,'label'=>'Notes'))

            ->add('save','submit',array('label'=>' Add'))
            ->getForm();






		return $form;
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



	private function get_contact_form(){

		$form = $this->createFormBuilder()
			->add('firstName','text')
			->add('lastName','text')
			->add('address','text')
			->add('postal','text')
			->add('country','text')
			->add('phone','text')
			->add('email','text')
			->add('message','textarea')
			->add('ip','text')
			->add('emailList', 'choice',array(
				'choices' => array('yes'=>'YES','no'=>'NO'),
				'required' => true,
			))
			->add('save','submit',array('label'=>'Inquiry'))
			->getForm();

		return $form;


	}




    private function get_app_settings() {
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);
    }
	/*
	 *

	private function get_tab_form($request){
		$tabmeta = new TabsMeta();

		$tabmeta->setProductId($request->query->get('productid'));
		$tabmeta->setUpdateDate(new \DateTime('now'));
		if ($tabmeta->getCreateDate() == null) {
			$tabmeta->setCreateDate(new \DateTime('now'));
		}

		$this->logger->notice('get form ID: '.$tabmeta->getProductId());
		$form = $this->createFormBuilder($tabmeta, array('csrf_protection' => false))
			->add('productId','hidden')
			->add('title','text')
			->add('type','choice', array(
										'choices' => array('html'=>'HTML', 'snippet'=>'Snippet','content'=>'Content')
										)
			)
			->add('snippet','choice', array(
										'choices'=>array_merge(array(''),$this->get_assets()),
										'required'=>false,

										)
			)
			->add('html','textarea', array('required'=>false))
			->add('tabOrder','number')
			->add('save','submit',array('label'=>'Update'))
			->getForm();
		return $form;
	}
	public function rmaFormUpdateAction($rmaSession){
		$this->get_app_settings();
		$form = $this->get_form_rma($rmaSession);
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$form->getData()->setUpdateDate();
			$em->persist($form->getData());
			$em->flush();
			return $this->redirect('/apps/fgms/rma/'.$form->getData()->getSession().'/');

		}
		$this->template_array['title'] = 'Update RMA '.substr($rmaSession,strlen($rmaSession) - 8,strlen($rmaSession));
		$this->template_array['form'] = $form->createView();

		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyProxy:index.html.twig',$this->template_array);
	}
	public function rmaAddItemsAction($rmaSession, $template_array = array()){
		$this->get_app_settings();
		$this->logger->notice("cmd ". $this->get('request')->get('cmd') . ' tool '. $this->get('request')->get('tool'));
		$this->template_array['focusitem'] = ($this->get('request')->query->has('item')) ? $this->get('request')->query->get('item') : 0;

		if ($this->get('request')->get('cmd') == 'delete'){
			$rmaItem = $this->getDoctrine()
				->getRepository('FgmsShopifyBundle:RmaItem')
				->findOneBy(array('id'=>intval($this->get('request')->get('tool')),'session'=>$rmaSession));

			$this->addFlash('notice','<strong>Tool Deleted</strong>
										<div>Tool Type: ' .$rmaItem->getToolType().'</div>
										<div>Tool Brand: ' .$rmaItem->getToolBrand().'</div>'
							);
			$rmaItem->setStatus('delete');
			$this->getDoctrine()->getManager()->flush();

		}
		else if ($this->get('request')->get('cmd') == 'edit'){

		}

		$rma = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:Rma')
			->findOneBy(array('session'=>$rmaSession));
		$rmaItems = $this->getDoctrine()
			->getRepository('FgmsShopifyBundle:RmaItem')
			->findBy(array('session'=>$rmaSession,'status'=>'active'));



		$this->template_array['rma'] = $rma;


		$rmaSession = $this->get('request')->query->get('session');
		$this->template_array['rmaItems'] = $rmaItems;
		$this->logger->notice('RMA ITEM '. $rma->getFirstName());
		$this->template_array['title'] ='RMA  ' . substr($rmaSession,strlen($rmaSession) - 8,strlen($rmaSession));
		$this->template_array = array_merge($this->template_array, $template_array);
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyProxy:rma-tools.html.twig',$this->template_array);
	}*/


}
