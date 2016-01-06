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
}
