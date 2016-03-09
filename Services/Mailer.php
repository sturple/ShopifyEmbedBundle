<?php

namespace Fgms\ShopifyBundle\Services;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\Yaml\Yaml;


class Mailer   {
	var $controller = null,
		$data=array(),
		$logger = null,
		$em = null;

	/*public function __construct(EntityManager $em, LoggerInterface $logger) {
		$this->em = $em;
		$this->logger = $logger;

	}*/
	public function __construct() {


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
			//$this->logger->notice('Sending Email for landing page '.$lpInquiry->getLandingPageId() .print_R($lp,true));
		}
	}


	public function sendEmail($properties){
		$prop = array_merge(array(	'to'=>array(),
									'cc'=>array(),
									'bcc'=>array(),
									'from'=>'postmaster@fifthgeardev.net',
									'subject'=>'',
									'html'=>'',
									'txt'=>''),
							$properties);
		$smtpSettings = $this->get_mailerParams();
		$errors = array();
		$mailStatus = false;
		$bodyFlag = false;
		if (( $smtpSettings !== false) && is_array($smtpSettings) ){
			$transport = \Swift_SmtpTransport::newInstance($smtpSettings['mailer_host'],$smtpSettings['mailer_port'],$smtpSettings['mailer_encryption'])
				->setUsername($smtpSettings['mailer_user'])
				->setPassword($smtpSettings['mailer_password']);
			$mailer = \Swift_Mailer::newInstance($transport);
			$message = \Swift_Message::newInstance()
				->setSubject($prop['subject'])
				->setFrom($prop['from'])
				->setTo($prop['to'])
				->setCc($prop['cc'])
				->setBcc($prop['bcc']);
			if (strlen($prop['html']) > 5){
				$message->setBody($prop['html'],'text/html');
				$bodyFlag  = true;
			}
			if (strlen($prop['txt']) > 5 ){
				if ($bodyFlag){
					$message->addPart($prop['txt'],'text/plain');
				} else {
					$message->setBody($prop['txt'],'text/plain');
				}
			}
			$mailStatus = $mailer->send($message);
		}

		return array('smtpsettings'=>$smtpSettings, 'to'=>$prop['to'], 'html-len'=>strlen($prop['html']),'txt-len'=>strlen($prop['txt']),'status'=>$mailStatus);
	}



	public function get_mailerParams(){
		$config = Yaml::parse(file_get_contents('/chroot/home/fifthgea/fifthgeardev.net/html/apps/app/config/parameters.yml'));
		if ( ( isset($config['parameters'])) && (count($config['parameters']) > 0) ){
			return $config['parameters'];
		}
		return false;
	}
}
?>
