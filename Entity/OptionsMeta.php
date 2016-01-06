<?php

namespace Fgms\ShopifyBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;

/**
 * OptionsMeta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OptionsMeta
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
     * @ORM\Column(name="productId", type="bigint")
     */
    private $productId;
    /**
     * @var string
     *
     * @ORM\Column(name="optionId", type="string", length=255,nullable=true )
     */
    private $optionId;
    /**
     * @var string
     *
     * @ORM\Column(name="optionDescription", type="string", length=255, nullable=true)
     */
    private $optionDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="optionType", type="string", length=255, nullable=true)
     */
    private $optionType;

    /**
     * @var integer
     *
     * @ORM\Column(name="optionOrder", type="integer")
     */
    private $optionOrder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime", nullable=true)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishOn", type="datetime", nullable=true)
     */
    private $publishOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishOff", type="datetime", nullable=true)
     */
    private $publishOff;

    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=255, nullable=true)
     */
    private $shop;

    /**
     * @var boolean
     *
     * @ORM\Column(name="optionEnable", type="boolean", nullable=true)
     */
    private $optionEnable;
    
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
     * Set productId
     *
     * @param integer $productId
     * @return OptionsMeta
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }
    /**
     * Set optionId
     *
     * @param string $optionId
     * @return OptionsMeta
     */
    public function setOptionId($optionId)
    {
        $this->optionId = $optionId;

        return $this;
    }

    /**
     * Get optionId
     *
     * @return string 
     */
    public function getOptionId()
    {
        return $this->optionId;
    }
    
    /**
     * Set optionDescription
     *
     * @param string $optionDescription
     * @return OptionsMeta
     */
    public function setOptionDescription($optionDescription)
    {
        $this->optionDescription = $optionDescription;

        return $this;
    }

    /**
     * Get optionDescription
     *
     * @return string 
     */
    public function getOptionDescription()
    {
        return $this->optionDescription;
    }

    /**
     * Set optionType
     *
     * @param string $optionType
     * @return OptionsMeta
     */
    public function setOptionType($optionType)
    {
        $this->optionType = $optionType;

        return $this;
    }

    /**
     * Get optionType
     *
     * @return string 
     */
    public function getOptionType()
    {
        return $this->optionType;
    }

    /**
     * Set optionOrder
     *
     * @param string $optionOrder
     * @return OptionsMeta
     */
    public function setOptionOrder($optionOrder)
    {
        $this->optionOrder = $optionOrder;

        return $this;
    }

    /**
     * Get optionOrder
     *
     * @return string 
     */
    public function getOptionOrder()
    {
        return $this->optionOrder;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return OptionsMeta
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

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
     * Set publishOn
     *
     * @param \DateTime $publishOn
     * @return OptionsMeta
     */
    public function setPublishOn($publishOn)
    {
        $this->publishOn = $publishOn;

        return $this;
    }

    /**
     * Get publishOn
     *
     * @return \DateTime 
     */
    public function getPublishOn()
    {
        return $this->publishOn;
    }

    /**
     * Set publishOff
     *
     * @param string $publishOff
     * @return OptionsMeta
     */
    public function setPublishOff($publishOff)
    {
        $this->publishOff = $publishOff;

        return $this;
    }

    /**
     * Get publishOff
     *
     * @return string 
     */
    public function getPublishOff()
    {
        return $this->publishOff;
    }

    /**
     * Set shop
     *
     * @param string $shop
     * @return OptionsMeta
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
     * Set optionEnable
     *
     * @param string $optionEnable
     * @return OptionsMeta
     */
    public function setOptionEnable($optionEnable)
    {
        $this->optionEnable = $optionEnable;

        return $this;
    }

    /**
     * Get optionEnable
     *
     * @return boolean 
     */
    public function getOptionEnable()
    {
        return $this->optionEnable;
    }
 
    
}
