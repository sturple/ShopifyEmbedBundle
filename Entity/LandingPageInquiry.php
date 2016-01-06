<?php
namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * LandingPageInquiry
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LandingPageInquiry
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
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
	
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=255, nullable=true)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="ipAddress", type="string", length=255, nullable=true)
     */
    private $ipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=255, nullable=true)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="postal", type="string", length=255, nullable=true)
     */
    private $postal;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var boolean
     *
     * @ORM\Column(name="list1", type="boolean", nullable=true)
     */
    private $list1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="list2", type="boolean", nullable=true)
     */
    private $list2;

    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=255)
     */
    private $shop;
	
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
     * @return LandingPageInquiry
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
     * Set firstName
     *
     * @param string $firstName
     * @return LandingPageInquiry
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return LandingPageInquiry
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * Set email
     *
     * @param string $email
     * @return LandingPageInquiry
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return LandingPageInquiry
     */
    public function setCreateDate()
    {
        $this->createDate =  new \DateTime("now");
        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set address1
     *
     * @param string $address1
     * @return LandingPageInquiry
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return LandingPageInquiry
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return LandingPageInquiry
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
     * Set province
     *
     * @param string $province
     * @return LandingPageInquiry
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set postal
     *
     * @param string $postal
     * @return LandingPageInquiry
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;

        return $this;
    }

    /**
     * Get postal
     *
     * @return string 
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return LandingPageInquiry
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return LandingPageInquiry
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return LandingPageInquiry
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set list1
     *
     * @param boolean $list1
     * @return LandingPageInquiry
     */
    public function setList1($list1)
    {
        $this->list1 = $list1;

        return $this;
    }

    /**
     * Get list1
     *
     * @return boolean 
     */
    public function getList1()
    {
        return $this->list1;
    }

    /**
     * Set list2
     *
     * @param boolean $list2
     * @return LandingPageInquiry
     */
    public function setList2($list2)
    {
        $this->list2 = $list2;

        return $this;
    }

    /**
     * Get list2
     *
     * @return boolean 
     */
    public function getList2()
    {
        return $this->list2;
    }
	

    /**
     * Set shop
     *
     * @param string $shop
     * @return LandingPageInquiry
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
}
