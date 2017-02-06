<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * ShopifyShopSettings
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fgms\ShopifyBundle\Entity\ShopifyShopSettingsRepository")
 */
class ShopifyShopSettings
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
     * @ORM\Column(name="accessToken", type="string", length=255)
     */
    private $accessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="storeName", type="string", length=255)
     */
    private $storeName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="storeUrl", type="string", length=255)
     */
    private $storeUrl;
    
    /**
     * @var string
     *
     * @ORM\Column(name="proxyUrl", type="string", length=255)
     */
    private $proxyUrl;    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    
    private $createDate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="landingPageEnable", type="string", length=20)
     */
    private $landingPageEnable;

    /**
     * @var string
     *
     * @ORM\Column(name="productReturnEnable", type="string", length=20)
     */
    private $productReturnEnable;

    /**
     * @var string
     *
     * @ORM\Column(name="specialEnable", type="string", length=20)
     */
    private $specialEnable;

   /**
    * @var string
    *
    * @ORM\Column(name="photoContestEnable", type="string", length=20)
    */
   private $photoContestEnable;

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
     * Set accessToken
     *
     * @param string $accessToken
     * @return ShopifyShopSettings
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
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
     * Set storeUrl
     *
     * @param string $storeUrl
     * @return ShopifyShopSettings
     */
    public function setStoreUrl($storeUrl)
    {
        $this->storeUrl = $storeUrl;

        return $this;
    }

    /**
     * Get storeUrl
     *
     * @return string
     */
    public function getStoreUrl()
    {
        return $this->storeUrl;
    }
    
    /**
     * Set proxyUrl
     *
     * @param string $proxyUrl
     * @return ShopifyShopSettings
     */
    public function setProxyUrl($proxyUrl)
    {
        $this->proxyUrl = $proxyUrl;

        return $this;
    }

    /**
     * Get proxyUrl
     *
     * @return string
     */
    public function getProxyUrl()
    {
        return $this->proxyUrl;
    }    
    

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return ShopifyShopSettings
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
     * Set status
     *
     * @param string $status
     * @return ShopifyShopSettings
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


    /*** enables ***/
    /**
     * Set landingPageEnable
     *
     * @param string $enable
     * @return ShopifyShopSettings
     */
    public function setLandingPageEnable($enable)
    {
        $this->landingPageEnable = $enable;

        return $this;
    }

    /**
     * Get landingPageEnable
     *
     * @return string
     */
    public function getLandingPageEnable()
    {
        return $this->landingPageEnable;
    }
    /**
     * Set productReturnEnable
     *
     * @param string $enable
     * @return ShopifyShopSettings
     */
    public function setProductReturnEnable($enable)
    {
        $this->productReturnEnable = $enable;

        return $this;
    }

    /**
     * Get productReturnEnable
     *
     * @return string
     */
    public function getProductReturnEnable()
    {
        return $this->productReturnEnable;
    }
    /**
     * Set specialEnable
     *
     * @param string $enable
     * @return ShopifyShopSettings
     */
    public function setSpecialEnable($enable)
    {
        $this->specialEnable = $enable;

        return $this;
    }

    /**
     * Get specialEnable
     *
     * @return string
     */
    public function getSpecialEnable()
    {
        return $this->specialEnable;
    }

    /**
     * Set photoContestEnable
     *
     * @param string $enable
     * @return ShopifyShopSettings
     */
    public function setphotoContestEnable($enable)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get photoContestEnable
     *
     * @return string
     */
    public function getPhotoContestEnable()
    {
        return $this->photoContestEnable;
    }



}
