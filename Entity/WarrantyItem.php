<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * WarrantyItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fgms\ShopifyBundle\Entity\RmaItemRepository")
 * @Vich\Uploadable
 */
class WarrantyItem
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
     * @ORM\Column(name="session", type="string", length=255, nullable=true)
     */
    private $session;

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
     * @var string
     *
     * @ORM\Column(name="quantity", type="string", length=100, nullable=true)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string", length=255, nullable=true)
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="productType", type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @var string
     *
     * @ORM\Column(name="productBrand", type="string", length=255, nullable=true)
     */
    private $productBrand;

    /**
     * @var string
     *
     * @ORM\Column(name="productNotes", type="text", nullable=true)
     */
    private $productNotes;

    /**
     * @var guid
     *
     * @ORM\Column(name="productImageGuid", type="guid", nullable=true)
     */
    private $productImageGuid;



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="rma_image", fileNameProperty="productImageGuid")     *
     * @var File
     * @Assert\File(
     *     maxSize = "2024k",
     *     mimeTypes = {"image/bmp", "image/jpeg", "image/jpg", "image/png","image/gif","application/pdf" },
     *     mimeTypesMessage = "Please upload a valid Image (bmp,jpeg,jpg,png,gif) or PDF",
     *     maxSizeMessage = "Please ensure your file is below 2024K"
     * )
     */
    private $productImageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="productImageBlob", type="blob", nullable=true)
     */
    private $productImageBlob;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=true)
     */
    private $status;


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
     * @return WarrantyItem
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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return WarrantyItem
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
     * Set quantity
     *
     * @param string $quantity
     * @return WarrantyItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quanity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }



    /**
     * Set productType
     *
     * @param string $productType
     * @return WarrantyItem
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
        return $this;
    }

    /**
     * Get productType
     *
     * @return string
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set productBrand
     *
     * @param string $productBrand
     * @return WarrantyItem
     */
    public function setProductBrand($productBrand)
    {
        $this->productBrand = $productBrand;
        return $this;
    }

    /**
     * Get productBrand
     *
     * @return string
     */
    public function getProductBrand()
    {
        return $this->productBrand;
    }


    /**
     * Set product
     *
     * @param string $product
     * @return WarrantyItem
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }



    /**
     * Set productNotes
     *
     * @param string $productNotes
     * @return WarrantyItem
     */
    public function setProductNotes($productNotes)
    {
        $this->productNotes = $productNotes;
        return $this;
    }


    /**
     * Get toolNotes
     *
     * @return string
     */
    public function getProductNotes()
    {
        return $this->productNotes;
    }


    /**
     * Set productImageGuid
     *
     * @param guid $productImageGuid
     * @return WarrantyItem
     */
    public function setProductImageGuid($productImageGuid)
    {
        $this->productImageGuid = $productImageGuid;

        return $this;
    }

    /**
     * Get productImageGuid
     *
     * @return guid
     */
    public function getProductImageGuid()
    {
        return $this->productImageGuid;
    }

    /**
     * Set productImageBlob
     *
     * @param string $productImageBlob
     * @return WarrantyItem
     */
    public function setProductImageBlob($productImageBlob)
    {
        $this->productImageBlob = $productImageBlob;

        return $this;
    }

    /**
     * Get productImageBlob
     *
     * @return string
     */
    public function getProductImageBlob()
    {
        return $this->productImageBlob;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return WarrantyItem
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
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return WarrantyItem
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

	/*
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $productImageFile
     */
    public function setProductImageFile(File $image = null)
    {
        $this->productImageFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getProductImageFile()
    {
        return $this->productImageFile;
    }


}
