<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentsMeta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fgms\ShopifyBundle\Entity\DocumentsMetaRepository")
 */
class DocumentsMeta
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="asset", type="string", length=255)
     */
    private $asset;

    /**
     * @var integer
     *
     * @ORM\Column(name="tabOrder", type="integer", nullable=true)
     */
    private $tabOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="productId", type="string", length=255)
     */
    private $productId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime", nullable=true)
     */
    private $updateDate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="storeName", type="string", length=255)
     */
    private $storeName;

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
     * @var string
     *
     * @ORM\Column(name="imageBase64", type="text")
     */
    private $imageBase64;
    
    
    /**
     * Set title
     *
     * @param string $title
     * @return DocumentsMeta
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
     * Set asset
     *
     * @param string $asset
     * @return DocumentsMeta
     */
    public function setAsset($asset)
    {
        $this->asset = $asset;

        return $this;
    }

    /**
     * Get asset
     *
     * @return string 
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * Set tabOrder
     *
     * @param integer $tabOrder
     * @return DocumentsMeta
     */
    public function setTabOrder($tabOrder)
    {
        $this->tabOrder = $tabOrder;

        return $this;
    }

    /**
     * Get tabOrder
     *
     * @return integer 
     */
    public function getTabOrder()
    {
        return $this->tabOrder;
    }

    /**
     * Set productId
     *
     * @param string $productId
     * @return DocumentsMeta
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return string 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return DocumentsMeta
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
     * @return DocumentsMeta
     */
    public function setUpdateDate()
    {
        $this->updateDate =  new \DateTime("now");

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
     * Set storeName
     *
     * @param string $storeName
     * @return ShopifyShopSettings
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
     * Get imageBase64
     *
     * @return string 
     */
    public function getImageBase64()
    {
        return $this->imageBase64;
    }

    /**
     * Set imageBase64
     *
     * @param string $imageBase64
     * @return ShopifyShopSettings
     */
    public function setImageBase64($imageBase64)
    {
        $this->imageBase64 = $imageBase64;

        return $this;
    }   
    
    
}
