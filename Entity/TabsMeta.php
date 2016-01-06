<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * TabsMeta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fgms\ShopifyBundle\Entity\TabsMetaRepository")
 */
class TabsMeta
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="tabOrder", type="integer")
     */
    private $tabOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="snippet", type="string", length=255, nullable=true)
     */
    private $snippet;

    /**
     * @var string
     *
     * @ORM\Column(name="html", type="text",  nullable=true)
     */
    private $html;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * 
     * 
     */
    private $createDate;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime")
     * 
     * 
     */
    private $updateDate;

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
     * @return integer
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
     * Set title
     *
     * @param string $title
     * @return TabsMeta
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
     * Set type
     *
     * @param string $type
     * @return TabsMeta
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tabOrder
     *
     * @param string $tabOrder
     * @return TabsMeta
     */
    public function setTabOrder($tabOrder)
    {
        $this->tabOrder = $tabOrder;

        return $this;
    }

    /**
     * Get tabOrder
     *
     * @return string 
     */
    public function getTabOrder()
    {
        return $this->tabOrder;
    }

    /**
     * Set snippet
     *
     * @param string $snippet
     * @return TabsMeta
     */
    public function setSnippet($snippet)
    {
        $this->snippet = $snippet;

        return $this;
    }

    /**
     * Get snippet
     *
     * @return string 
     */
    public function getSnippet()
    {
        return $this->snippet;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return TabsMeta
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set createDate
     *
     * @param string $createDate
     * @return TabsMeta
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return string 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }
    
    
    /**
     * Set updateDate
     *
     * @param string $updateDate
     * @return TabsMeta
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return string 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }
    
    

}
