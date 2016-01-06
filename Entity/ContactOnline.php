<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ContactOnline
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fgms\ShopifyBundle\Entity\ContactOnlineRepository")
 */
class ContactOnline
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
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=128, nullable=true)
     */	
    private $ip;
	
	
    /**
     * @var string
     *
     * @ORM\Column(name="formType", type="string", length=128, nullable=true)
     */	
    private $formType;	
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime", nullable=true)
     */
    private $createDate;
	
	
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
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

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
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;


    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="tollPhone", type="string", length=20, nullable=true)
     */
    private $tollPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;	
	
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="utility", type="text", nullable=true)
     */
    private $utility;

    /**
     * @var string
     *
     * @ORM\Column(name="fileUploadBlob", type="blob", nullable=true)
     */
    private $fileUploadBlob;

    /**
     * @var boolean
     *
     * @ORM\Column(name="listA", type="boolean", nullable=true)
     */
    private $listA;

    /**
     * @var boolean
     *
     * @ORM\Column(name="listB", type="boolean", nullable=true)
     */
    private $listB;

    /**
     * @var boolean
     *
     * @ORM\Column(name="listC", type="boolean", nullable=true)
     */
    private $listC;

	
    /**
     * @var string
     *
     * @ORM\Column(name="mailToEmail", type="string", length=255, nullable=true)
     */
    private $mailToEmail;		
    /**
     * @var string
     *
     * @ORM\Column(name="mailCcEmail", type="string", length=255, nullable=true)
     */
    private $mailCcEmail;
    /**
     * @var string
     *
     * @ORM\Column(name="mailBccEmail", type="string", length=255, nullable=true)
     */
    private $mailBccEmail;	
    /**
     * @var string
     *
     * @ORM\Column(name="mailMessage", type="blob", nullable=true)
     */
    private $mailMessage;
	
    /**
     * @var string
     *
     * @ORM\Column(name="returnUrl", type="string", length=255, nullable=true)
     */
    private $returnUrl;		

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
     * Set ip
     *
     * @param string $ip
     * @return ContactOnline
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }
	
    /**
     * Set formType
     *
     * @param string $formType
     * @return ContactOnline
     */
    public function setFormType($formType)
    {
        $this->fromType = $formType;

        return $this;
    }

    /**
     * Get formType
     *
     * @return string 
     */
    public function getFormType()
    {
        return $this->formType;
    }	
    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return RmaItem
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
     * Set firstName
     *
     * @param string $firstName
     * @return ContactOnline
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
     * @return ContactOnline
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
     * Set address1
     *
     * @param string $address1
     * @return ContactOnline
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
     * @return ContactOnline
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
     * Set city
     *
     * @param string $city
     * @return ContactOnline
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
     * Set province
     *
     * @param string $province
     * @return ContactOnline
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
     * @return ContactOnline
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
     * Set country
     *
     * @param string $country
     * @return ContactOnline
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
     * Set phone
     *
     * @param string $phone
     * @return ContactRequest
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set tollPhone
     *
     * @param string $tollPhone
     * @return ContactRequest
     */
    public function setTollPhone($tollPhone)
    {
        $this->tollPhone = $tollPhone;

        return $this;
    }

    /**
     * Get tollPhone
     *
     * @return string 
     */
    public function getTollPhone()
    {
        return $this->tollPhone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return ContactRequest
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
     * Set message
     *
     * @param string $message
     * @return ContactOnline
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
     * Set utility
     *
     * @param string $utility
     * @return ContactOnline
     */
    public function setUtility($utility)
    {
        $this->utility = $utility;

        return $this;
    }

    /**
     * Get utility
     *
     * @return string 
     */
    public function getUtility()
    {
        return $this->utility;
    }

    /**
     * Set fileUploadBlob
     *
     * @param string $fileUploadBlob
     * @return ContactOnline
     */
    public function setFileUploadBlob($fileUploadBlob)
    {
        $this->fileUploadBlob = $fileUploadBlob;

        return $this;
    }

    /**
     * Get fileUploadBlob
     *
     * @return string 
     */
    public function getFileUploadBlob()
    {
        return $this->fileUploadBlob;
    }

    /**
     * Set listA
     *
     * @param boolean $listA
     * @return ContactOnline
     */
    public function setListA($listA)
    {
        $this->listA = $listA;

        return $this;
    }

    /**
     * Get listA
     *
     * @return boolean 
     */
    public function getListA()
    {
        return $this->listA;
    }

    /**
     * Set listB
     *
     * @param boolean $listB
     * @return ContactOnline
     */
    public function setListB($listB)
    {
        $this->listB = $listB;

        return $this;
    }

    /**
     * Get listB
     *
     * @return boolean 
     */
    public function getListB()
    {
        return $this->listB;
    }

    /**
     * Set listC
     *
     * @param boolean $listC
     * @return ContactOnline
     */
    public function setListC($listC)
    {
        $this->listC = $listC;

        return $this;
    }

    /**
     * Get listC
     *
     * @return boolean 
     */
    public function getListC()
    {
        return $this->listC;
    }
	


    /**
     * Set mailToEmail
     *
     * @param string $mailToEmail
     * @return ContactRequest
     */
    public function setMailToEmail($mailToEmail)
    {
        $this->mailToEmail = $mailToEmail;
        return $this;
    }

    /**
     * Get mailToEmail
     *
     * @return string 
     */
    public function getMailToEmail()
    {
        return $this->mailToEmail;
    }
	
    /**
     * Set mailCcEmail
     *
     * @param string $mailCcEmail
     * @return ContactRequest
     */
    public function setMailCcEmail($mailCcEmail)
    {
        $this->mailCcEmail = $mailCcEmail;
        return $this;
    }

    /**
     * Get mailCcEmail
     *
     * @return string 
     */
    public function getMailCcEmail()
    {
        return $this->mailCcEmail;
    }		
    /**
     * Set mailBccEmail
     *
     * @param string $mailBccEmail
     * @return ContactRequest
     */
    public function setMailBccEmail($mailBccEmail)
    {
        $this->mailBccEmail = $mailBccEmail;
        return $this;
    }

    /**
     * Get mailBccEmail
     *
     * @return string 
     */
    public function getMailBccEmail()
    {
        return $this->mailBccEmail;
    }		

    /**
     * Set mailMessage
     *
     * @param string $mailMessage
     * @return ContactRequest
     */
    public function setMailMessage($mailMessage)
    {
        $this->mailMessage = $mailMessage;
        return $this;
    }

    /**
     * Get mailMessage
     *
     * @return string 
     */
    public function getMailMessage()
    {
        return $this->mailMessage;
    }	
	
    /**
     * Set returnUrl
     *
     * @param string $returnUrl
     * @return ContactRequest
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * Get returnUrl
     *
     * @return string 
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }		
	
}
