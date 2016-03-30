<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Customers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fgms\ShopifyBundle\Entity\RmaRepository")
 */
class Customers
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
     * @ORM\Column(name="session", type="string", length=255)
     */
    private $session;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=24)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction", type="string", length=24)
     */
    private $transaction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime" , nullable=true )
     */

    private $createDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=30,  nullable=true)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime",  nullable=true)
     */
    private $updateDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="collectionDate", type="datetime",  nullable=true)     *
     */
    private $collectionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="storeName", type="string", length=255)
     */
    private $storeName;


    /**
     * @var string
     *
     * @ORM\Column(name="transport", type="string", length=255,  nullable=true)
     */
    private $transport;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255,  nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255,  nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255 )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=255)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255,nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postal", type="string", length=255)
     */
    private $postal;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=255)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255,  nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneToll", type="string", length=20,  nullable=true)
     */
    private $phoneToll;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneMobile", type="string", length=20 , nullable=true)
     */
    private $phoneMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneOffice", type="string", length=20,  nullable=true)
     */
    private $phoneOffice;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneFax", type="string", length=20,  nullable=true)
     */
    private $phoneFax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text",  nullable=true)
     */
    private $notes;


    /**
     * @var string
     *
     * @ORM\Column(name="purchaseLocation", type="string", length=255, nullable=true)
     */
    private $purchaseLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="purchaseReceipt", type="string", length=255,nullable=true )
     */
    private $purchaseReceipt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchaseDate", type="datetime",  nullable=true)
     */
    private $purchaseDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="terms", type="boolean",  nullable=true)
     */
    private $terms;

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
     * Set session
     *
     * @param string $session
     * @return Customers
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Customers
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set transaction
     *
     * @param string $status
     * @return Customers
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return string
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Customers
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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Customers
     */
    public function setCreateDate()
    {
        $this->createDate = new \DateTime("now");

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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Customers
     */
    public function setCollectionDate($collectionDate)
    {
        $this->createDate = $collectionDate;

        return $this;
    }

    /**
     * Get collectionDate
     *
     * @return \DateTime
     */
    public function getCollectionDate()
    {
        return $this->collectionDate;
    }


    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return Customers
     */
    public function setUpdateDate()
    {
        $this->updateDate = new \DateTime("now");

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set transport
     *
     * @param string $transport
     * @return Customers
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Customers
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Customers
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
     * @return Customers
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
     * @return Customers
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
     * @return Customers
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
     * @return Customers
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
     * Set postal
     *
     * @param string $postal
     * @return Customers
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
     * Set province
     *
     * @param string $province
     * @return Customers
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
     * Set country
     *
     * @param string $country
     * @return Customers
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
     * Set phoneToll
     *
     * @param string $phoneToll
     * @return Customers
     */
    public function setPhoneToll($phoneToll)
    {
        $this->phoneToll = $phoneToll;

        return $this;
    }

    /**
     * Get phoneToll
     *
     * @return string
     */
    public function getPhoneToll()
    {
        return $this->phoneToll;
    }

    /**
     * Set phoneMobile
     *
     * @param string $phoneMobile
     * @return Customers
     */
    public function setPhoneMobile($phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    /**
     * Get phoneMobile
     *
     * @return string
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * Set phoneOffice
     *
     * @param string $phoneOffice
     * @return Customers
     */
    public function setPhoneOffice($phoneOffice)
    {
        $this->phoneOffice = $phoneOffice;

        return $this;
    }

    /**
     * Get phoneOffice
     *
     * @return string
     */
    public function getPhoneOffice()
    {
        return $this->phoneOffice;
    }

    /**
     * Set phoneFax
     *
     * @param string $phoneFax
     * @return Customers
     */
    public function setPhoneFax($phoneFax)
    {
        $this->phoneFax = $phoneFax;

        return $this;
    }

    /**
     * Get phoneFax
     *
     * @return string
     */
    public function getPhoneFax()
    {
        return $this->phoneFax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customers
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
     * Set notes
     *
     * @param string $notes
     * @return Customers
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }


    /**
     * Set storeName
     *
     * @param string $storeName
     * @return Customers
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;

        return $this;
    }

    /**
     * Get storeName
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->storeName;
    }





    /**
     * Set purchaseLocation
     *
     * @param string $purchaseLocation
     * @return Customers
     */
    public function setPurchaseLocation($purchaseLocation)
    {
        $this->purchaseLocation = $purchaseLocation;

        return $this;
    }

    /**
     * Get purchaseLocation
     *
     * @return string
     */
    public function getPurchaseLocation()
    {
        return $this->purchaseLocation;
    }

    /**
     * Set purchaseReceipt
     *
     * @param string $purchaseReceipt
     * @return Customers
     */
    public function setPurchaseReceipt($purchaseReceipt)
    {
        $this->purchaseReceipt = $purchaseReceipt;

        return $this;
    }

    /**
     * Get purchaseReceipt
     *
     * @return string
     */
    public function getPurchaseReceipt()
    {
        return $this->purchaseReceipt;
    }

    /**
     * Set purchaseDate
     *
     * @param string $purchaseDate
     * @return Customers
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    /**
     * Get purchaseDate
     *
     * @return string
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
      * Set terms
      *
      * @param boolean $terms
      * @return Customers
      */
     public function setTerms($terms)
     {
         $this->terms = $terms;

         return $this;
     }

     /**
      * Get terms
      *
      * @return boolean
      */
     public function getTerms()
     {
         return $this->terms;
     }

}
