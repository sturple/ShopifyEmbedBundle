<?php
namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * EventTracking
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EventTracking
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="landingPageId", type="integer")
     */
    private $landingPageId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eventDate", type="datetime", nullable=true)
     */
    private $eventDate;

    /**
     * @var string
     *
     * @ORM\Column(name="eventCategory", type="string", length=255, nullable=true)
     */
    private $eventCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="eventLabel", type="string", length=255, nullable=true)
     */
    private $eventLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="eventAction", type="string", length=255, nullable=true)
     */
    private $eventAction;

    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=255, nullable=true)
     */
    private $shop;

    /**
     * @var string
     *
     * @ORM\Column(name="refererUrl", type="string", length=255, nullable=true)
     */
    private $refererUrl;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ipAddress", type="string", length=255, nullable=true)
     */
    private $ipAddress;    
    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set landingPageId
     *
     * @param integer $landingPageId
     * @return EventTracking
     */
    public function setLandingPageId($landingPageId)
    {
        $this->landingPageId = $landingPageId;

        return $this;
    }

    /**
     * Get landingPageId
     *
     * @return integer 
     */
    public function getLandingPageId()
    {
        return $this->landingPageId;
    }

    /**
     * Set eventDate
     *
     * @param \DateTime $eventDate
     * @return EventTracking
     */
    public function setEventDate()
    {
        $this->eventDate =  new \DateTime("now");

        return $this;
    }

    /**
     * Get eventDate
     *
     * @return \DateTime 
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * Set eventCategory
     *
     * @param string $category
     * @return EventTracking
     */
    public function setEventCategory($category)
    {
        $this->eventCategory = $category;

        return $this;
    }

    /**
     * Get eventCategory
     *
     * @return string 
     */
    public function getEventCategory()
    {
        return $this->eventCategory;
    }

    /**
     * Set eventLabel
     *
     * @param string $eventLabel
     * @return EventTracking
     */
    public function setEventLabel($eventLabel)
    {
        $this->eventLabel = $eventLabel;

        return $this;
    }

    /**
     * Get eventLabel
     *
     * @return string 
     */
    public function getEventLabel()
    {
        return $this->eventLabel;
    }

    /**
     * Set eventAction
     *
     * @param string $eventValue
     * @return EventTracking
     */
    public function setEventAction($eventAction)
    {
        $this->eventAction = $eventAction;

        return $this;
    }

    /**
     * Get eventAction
     *
     * @return string 
     */
    public function getEventAction()
    {
        return $this->eventAction;
    }

    /**
     * Set shop
     *
     * @param string $shop
     * @return EventTracking
     */
    public function setShop($shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return string 
     */
    public function getShop()
    {
        return $this->shop;
    }
    

 
    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return EventTracking
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }   
    
    
    
    /**
     * Set refererUrl
     *
     * @param string $refererUrl
     * @return EventTracking
     */
    public function setRefererUrl($refererUrl)
    {
        $this->refererUrl = $refererUrl;

        return $this;
    }

    /**
     * Get refererUrl
     *
     * @return string 
     */
    public function getRefererUrl()
    {
        return $this->refererUrl;
    }    
    
}
