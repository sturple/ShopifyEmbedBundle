<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Specials
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Vich\Uploadable
 */

 
 
class Specials
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
     * @ORM\Column(name="status", type="string", length=20, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=255, nullable=true)
     */
    private $shop;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime", nullable=true)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime", nullable=true)
     */
    private $updateDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishDate", type="datetime", nullable=true)
     */
    private $publishDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="unpublishDate", type="datetime", nullable=true)
     */
    private $unpublishDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="buttonText", type="string", length=255, nullable=true)
     */
    private $buttonText;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="productURL", type="string", length=255, nullable=true)
     */
    private $productURL;

    /**
     * @var string
     *
     * @ORM\Column(name="collectionURL", type="string", length=255, nullable=true)
     */
    private $collectionURL;

    /**
     * @var string
     *
     * @ORM\Column(name="pageURL", type="string", length=255, nullable=true)
     */
    private $pageURL;

    /**
     * @var string
     *
     * @ORM\Column(name="imageGuid", type="string", length=255, nullable=true)
     */
    private $imageGuid;
	
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="specials_image", fileNameProperty="imageGuid")
     * 
     * @var File
     */
    private $imageFile;		
	

    /**
     * @var string
     *
     * @ORM\Column(name="permalink", type="string", length=255, nullable=true)
     */
    private $permalink;

    /**
     * @var string
     *
     * @ORM\Column(name="shortlink", type="string", length=255, nullable=true)
     */
    private $shortlink;

    /**
     * @var boolean
     *
     * @ORM\Column(name="shortlinkEnable", type="boolean", nullable=true)
     */
    private $shortlinkEnable;


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
     * Set status
     *
     * @param string $status
     * @return Specials
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
     * Set shop
     *
     * @param string $shop
     * @return Specials
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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Specials
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
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return Specials
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
     * Set publishDate
     *
     * @param \DateTime $publishDate
     * @return Specials
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime 
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set unpublishDate
     *
     * @param \DateTime $unpublishDate
     * @return Specials
     */
    public function setUnpublishDate($unpublishDate)
    {
        $this->unpublishDate = $unpublishDate;

        return $this;
    }

    /**
     * Get unpublishDate
     *
     * @return \DateTime 
     */
    public function getUnpublishDate()
    {
        return $this->unpublishDate;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Specials
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Specials
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Specials
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set buttonText
     *
     * @param string $buttonText
     * @return Specials
     */
    public function setButtonText($buttonText)
    {
        $this->buttonText = $buttonText;

        return $this;
    }

    /**
     * Get buttonText
     *
     * @return string 
     */
    public function getButtonText()
    {
        return $this->buttonText;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Specials
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set productURL
     *
     * @param string $productURL
     * @return Specials
     */
    public function setProductURL($productURL)
    {
        $this->productURL = $productURL;

        return $this;
    }

    /**
     * Get productURL
     *
     * @return string 
     */
    public function getProductURL()
    {
        return $this->productURL;
    }

    /**
     * Set collectionURL
     *
     * @param string $collectionURL
     * @return Specials
     */
    public function setCollectionURL($collectionURL)
    {
        $this->collectionURL = $collectionURL;

        return $this;
    }

    /**
     * Get collectionURL
     *
     * @return string 
     */
    public function getCollectionURL()
    {
        return $this->collectionURL;
    }

    /**
     * Set pageURL
     *
     * @param string $pageURL
     * @return Specials
     */
    public function setPageURL($pageURL)
    {
        $this->pageURL = $pageURL;

        return $this;
    }

    /**
     * Get pageURL
     *
     * @return string 
     */
    public function getPageURL()
    {
        return $this->pageURL;
    }

    /**
     * Set imageGuid
     *
     * @param string $imageGuid
     * @return Specials
     */
    public function setImageGuid($imageGuid)
    {
        $this->imageGuid = $imageGuid;

        return $this;
    }

    /**
     * Get imageGuid
     *
     * @return string 
     */
    public function getImageGuid()
    {
        return $this->imageGuid;
    }

    /**
     * Set permalink
     *
     * @param string $permalink
     * @return Specials
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }
	
	/* 
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }	
	

    /**
     * Get permalink
     *
     * @return string 
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * Set shortlink
     *
     * @param string $shortlink
     * @return Specials
     */
    public function setShortlink($shortlink)
    {
        $this->shortlink = $shortlink;

        return $this;
    }

    /**
     * Get shortlink
     *
     * @return string 
     */
    public function getShortlink()
    {
        return $this->shortlink;
    }

    /**
     * Set shortlinkEnable
     *
     * @param boolean $shortlinkEnable
     * @return Specials
     */
    public function setShortlinkEnable($shortlinkEnable)
    {
        $this->shortlinkEnable = $shortlinkEnable;

        return $this;
    }

    /**
     * Get shortlinkEnable
     *
     * @return boolean 
     */
    public function getShortlinkEnable()
    {
        return $this->shortlinkEnable;
    }
}
