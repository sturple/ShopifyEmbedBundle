<?php

namespace Fgms\ShopifyBundle\Services;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

class Mailer  {
	var $controller = null,
		$data=array(),
		$logger = null,
		$em = null;
												  
	public function __construct(EntityManager $em, LoggerInterface $logger) {
		$this->em = $em;
		$this->logger = $logger;
		
	}
	
	public function sendLandingPageEmail($lpInquiry,$settings){
		// prop will be passed to sendEmail function
		$twig = new \Twig_Environment(new \Twig_Loader_String());
		$twigFile = new \Twig_Environment(new \Twig_Loader_Fielsystem());
		$template = 'FgmsShopifyBundle:Email:email-base.html.twig';
		$data = array('inquiry'=>$lpInquiry,'global'=>$settings);
		$id = intval($lpInquiry->getLandingPageId());
		if ($id > 0){
			$lp = $this->em
				->getRepository('FgmsShopifyBundle:LandingPage')
				->findOneBy(array('id'=>$id));
				
			$template_array['lp'] = $lp;
			$prop['from'] = array('webmaster@fifthgeardev.com'=>$lp->getCompany());
			
			// Company email
			if ($lp->getEmailEnable() == 1){
				$prop['to'] = explode(',',$lp->getEmailTo());
				$prop['cc'] = explode(',',$lp->getEmailCc());
				$prop['bcc'] = explode(',',$lp->getEmailBcc());
				$prop['subject'] = $twig->render($lp->getEmailSubject(),$data);					
				$prop['html'] = $twigFile->render($template,array_merge(array('content'=>$twig->render($lp->getEmailMessageHtml(),$data),$data )));
				$prop['text'] = $twig->render($lp->getEmailMessageText(),$data);
				
			}
			//client email
			if ($lp->getEmailCustomerEnable() == 1){
				$prop['to'] = array($lpInquiry->getEmail()=>$lpInquiry->getFirstName(). ' ',$lpInquiry->getLastName());
				$prop['cc'] = explode(',',$lp->getEmailCustomerCc());
				$prop['bcc'] = explode(',',$lp->getEmailCustomerBcc());
				$prop['subject'] = $twig->render($lp->getEmailCustomerSubject(),$data);	
				$prop['html'] = $twigFile->render($template,array_merge(array('content'=>$twig->render($lp->getEmailCustomerMessageHtml(),$data),$data)));	
				$prop['text'] = $twig->render($lp->getEmailCustomerMessageText(),$data);			
				
			}
			
			
			$this->logger->notice('Sending Email for landing page '.$lpInquiry->getLandingPageId() .print_R($lp,true));				
		}

		
		
		
	}
	
	
	public function sendEmail($properties){
		$this->controller = $controller;
		$this->data = $data;

		
		$render = $twig->render( "Test string template: {{ firstName }}", array('firstName'=>$form->get('firstName')->getData()))	;
		$message = \Swift_Message::newInstance()
			->setSubject('Testing Swift Mailer')
			->setFrom('wp.shawn.turple@fifthgeardev.com')
			->setTo('shawn.turple@shaw.ca')
			->setBody($render,'text/html')
			
			/*
			 * If you also want to include a plaintext version of the message
			->addPart(
				$this->renderView(
					'Emails/registration.txt.twig',
					array('name' => $name)
				),
				'text/plain'
			)
			*/
		;
		$controller->logger->notice($render);
		$controller->get('mailer')->send($message);			
	}
	public function get_test(){
		return 'this if from the mailer class';
	}
}
?>