<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Fgms\ShopifyBundle\Model\ShopifyClient;

use \Fgms\ShopifyBundle\Entity\ContestEntry;
use \Fgms\ShopifyBundle\Form\ContestEntryType;

class ShopifyContestController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$theme,
		$store_name,
		$redirect_url,
        $liquidStr = "{% include 'shortcode-classic-series' %}",
		$template_array = array();


	public function indexAction(){
		$this->get_app_settings();
		return $this->render('FgmsShopifyBundle:ShopifyContest:index.html.twig',$this->template_array);
	}



	public function publicAction($permalink){
		$this->get_app_settings();
		$this->template_array['title'] ='Contest ';

		$contestEntry = new ContestEntry();
		if ($contestEntry->getCreateDate() == null){
			$contestEntry->setIpAddress($this->get('request')->server->get('HTTP_X_REAL_IP'));
			$contestEntry->setCreateDate();
            $contestEntry->setUpdateDate();
			$contestEntry->setShop($this->store_name);
            $contestEntry->setContestId($permalink);
		}

		$contestEntryType = new ContestEntryType();
		//$this->logger->notice('landing page inquiry type '.print_R($lpit->getOptions(),true));
		$form = $this->createForm($contestEntryType,$contestEntry);


		//form requests
		$form->handleRequest($this->get('request'));
		if ($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($form->getData());
			$em->flush();
            //client email
            $imageUrl = 'https://apps.fifthgeardev.net/uploads/contest/'.$contestEntry->getPhotoGuid();
            $globals = $this->get('fgms.settings')->getFormSettings($this->store_name);
            $storeDetails = $this->shopify->call('GET','/admin/shop.json');

            $data = array_merge($this->template_array,
                                array(  'global'=>$globals,
                                        'email'=> array(
                                            'introtext'=>'<p>Hello '. $contestEntry->getFirstName(). ',</p>This message is simply to confirm that your contest entry has been received by PEETZ Outdoors. Good luck!',
                                            'content'=>'Note that you can also receive additional entries each month by posting your photos to our various social pages
                                            (Facebook, Twitter, Instagram, Pinterest).  For more details and instructions, <a href="" style="text-decoration: none;color: #'.$globals->getColorLink() .'">click here</a>.',

                                        ),
                                        'fields'=>array(
                                                'date'=>array('label'=>'Date','value'=>$contestEntry->getCreateDate()->format('Y-m-d H:i:s')),
                                                'firstName'=>array('label'=>'First Name', 'value'=>$contestEntry->getFirstName()),
                                                'lastName'=>array('label'=>'Last Name', 'value'=>$contestEntry->getLastName()),
                                                'email'=>array('label'=>'Email', 'value'=>'<a href="mailto:' .$contestEntry->getEmail().'" style="text-decoration: none; color: #'.$globals->getColorLink() .';">'.$contestEntry->getEmail(). '</a>'),
                                                'location'=>array('label'=>'Location','value'=>$contestEntry->getLocation()),
                                                'description'=>array('label'=>'Description','value'=>$contestEntry->getDescription()),
                                                'photo_date'=>array('label'=>'Photo Date','value'=>$contestEntry->getPhotoDate()->format('Y-m-d')),
                                                'photo_url'=>array('label'=>'Photo URL','value'=>'<a href="'.$imageUrl.'" style="text-decoration: none; color: #'.$globals->getColorLink() .';" target="_blank">' .$imageUrl .'</a>')
                                            ),
                                        'store'=>$storeDetails
                                        )
                                );
            
            $this->get('fgms.mailer')->sendEmail(array( 'to'=>array($contestEntry->getEmail()),
                                                        'subject'=>'Monthly Photo Contest Entry | ' . $storeDetails['name'],
                                                        'html'=>$this->renderView('FgmsShopifyBundle:Emails:Contest-client-email.html.twig',$data),
                                                        'txt'=>$this->renderView('FgmsShopifyBundle:Emails:Contest-client-email.txt.twig',$data)

                                                    ));

            //company email
            $data['email']['title'] = 'Monthly Photo Contest Entry';
            unset($data['email']['content']);
            unset($data['email']['subtitle']);
            unset($data['email']['introtext']);
            $this->get('fgms.mailer')->sendEmail(array( 'to'=>array('shawn.turple@fifthgeardev.com'),
                                                        'bcc'=>array('webmaster@fifthgeardev.com'),
                                                        'subject'=>'Monthly Photo Contest Entry | ' . $storeDetails['name'],
                                                        'html'=>$this->renderView('FgmsShopifyBundle:Emails:Contest-store-email.html.twig',$data),
                                                        'txt'=>$this->renderView('FgmsShopifyBundle:Emails:Contest-store-email.txt.twig',$data)

                                                    ));
            //$(this)->get('fgms.mailer')->sendEmail()
            return $this->redirect('/../../pages/product-question-delivered');
			//$this->get('fgms.mailer')->sendContestEmail($contestEntry,$this->get('fgms.settings')->getFormSettings($this->store_name));
			//$this->sendEmailMessage($form, $formType);

		}



		$this->template_array['form'] = $form->createView();
		return $this->renderAsLiquid('FgmsShopifyBundle:ShopifyContest:contest.html.twig',$this->template_array);
	}



	private function renderAsLiquid($template, $array=array()){
		$response = new Response(
			'Content',
			Response::HTTP_OK,
			array('content-type' => 'application/liquid')
		);
		$response->setContent(str_replace('[[headingSnippet]]',$this->liquidStr,$this->renderView($template, $array)));
		return $response;
	}

    private function get_app_settings() {
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);
    }


}
