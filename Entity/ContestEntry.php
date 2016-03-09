<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
* ContestEntry
*
* @ORM\Table()
* @ORM\Entity
* @Vich\Uploadable
*/
class ContestEntry
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
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime", nullable=true)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime",  nullable=true)
     */
    private $updateDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ipAddress", type="string", length=24, nullable=true)
     */
    private $ipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="contestId", type="string", length=255, nullable=true)
     */
    private $contestId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="photoDate", type="datetime", nullable=true)
     */
    private $photoDate;

    /**
     * @var string
     *
     * @ORM\Column(name="photoGuid", type="string", length=255, nullable=true)
     */
    private $photoGuid;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="settings_contest", fileNameProperty="photoGuid")
     *
     * @var File
     */
    private $photoFile;




    /**
     * @var string
     *
     * @ORM\Column(name="photoUrl", type="string", length=255, nullable=true)
     */
    private $photoUrl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="terms", type="boolean", nullable=true)
     */
    private $terms;

    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=255, nullable=true)
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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return ContestEntry
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
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return Rma
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
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return ContestEntry
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
     * Set contestId
     *
     * @param string $contestId
     * @return ContestEntry
     */
    public function setContestId($contestId)
    {
        $this->contestId = $contestId;

        return $this;
    }

    /**
     * Get contestId
     *
     * @return string
     */
    public function getContestId()
    {
        return $this->contestId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ContestEntry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return ContestEntry
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
     * Set location
     *
     * @param string $location
     * @return ContestEntry
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ContestEntry
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set photoDate
     *
     * @param \DateTime $photoDate
     * @return ContestEntry
     */
    public function setPhotoDate($photoDate)
    {
        $this->photoDate = $photoDate;

        return $this;
    }

    /**
     * Get photoDate
     *
     * @return \DateTime
     */
    public function getPhotoDate()
    {
        return $this->photoDate;
    }

    /**
     * Set photoGuid
     *
     * @param string $photoGuid
     * @return ContestEntry
     */
    public function setPhotoGuid($photoGuid)
    {
        $this->photoGuid = $photoGuid;

        return $this;
    }

    /**
     * Get photoGuid
     *
     * @return string
     */
    public function getPhotoGuid()
    {
        return $this->photoGuid;
    }

    /*
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $photoFile
     */
    public function setPhotoFile(File $image = null)
    {
        $this->photoFile = $image;
        if ($image) { $this->setUpdateDate();  }
        return $this;
    }


    /**
     * Get photoFile
     *
     * @return string
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }
    /**
     * Set photoUrl
     *
     * @param string $photoUrl
     * @return ContestEntry
     */
    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }

    /**
     * Get photoUrl
     *
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    /**
     * Set terms
     *
     * @param boolean $terms
     * @return ContestEntry
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
