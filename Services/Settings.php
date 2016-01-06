<?php

namespace Fgms\ShopifyBundle\Services;
use Doctrine\ORM\EntityManager;
use \Fgms\ShopifyBundle\Entity\FormSettings;
use Psr\Log\LoggerInterface;
class Settings  {
		var $em = null,
		$logger = null;
												  
	public function __construct(EntityManager $em, LoggerInterface $logger) {
		$this->em = $em;
		$this->logger = $logger;
		
	}
	
	public function getFormSettings($shop){
		$settings = $this->em
			->getRepository('FgmsShopifyBundle:FormSettings')
			->findOneBy(array('shop'=>$shop));
		if ($settings){
			return $settings;
		}
		return new FormSettings();
	}
	
	
}
?>