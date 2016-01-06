<?php

namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * FormSettings
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Vich\Uploadable
 */
class FormSettings
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
     * @ORM\Column(name="updateDate", type="datetime")
     */
    private $updateDate;

    /**
     * @var string
     *
     * @ORM\Column(name="logoGUID", type="string", length=255, nullable=true)
     */
    private $logoGuid;

    /**
     * @var string
     *
     * @ORM\Column(name="logoText", type="string", length=255, nullable=true)
     */
    private $logoText;

    /**
     * @var string
     *
     * @ORM\Column(name="colorLink", type="string", length=10, nullable=true)
     */
    private $colorLink;

    /**
     * @var string
     *
     * @ORM\Column(name="colorLinkHover", type="string", length=10, nullable=true)
     */
    private $colorLinkHover;

    /**
     * @var string
     *
     * @ORM\Column(name="colorBackgroundBody", type="string", length=10, nullable=true)
     */
    private $colorBackgroundBody;

    /**
     * @var string
     *
     * @ORM\Column(name="colorBackgroundContent", type="string", length=10, nullable=true)
     */
    private $colorBackgroundContent;

    /**
     * @var string
     *
     * @ORM\Column(name="colorBackgroundFooter", type="string", length=10, nullable=true)
     */
    private $colorBackgroundFooter;

    /**
     * @var string
     *
     * @ORM\Column(name="colorBackgroundHeader", type="string", length=10, nullable=true)
     */
    private $colorBackgroundHeader;

    /**
     * @var string
     *
     * @ORM\Column(name="colorTitle", type="string", length=10, nullable=true)
     */
    private $colorTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="colorSubtitle", type="string", length=10, nullable=true)
     */
    private $colorSubtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="colorText", type="string", length=10, nullable=true)
     */
    private $colorText;

    /**
     * @var string
     *
     * @ORM\Column(name="templateWrapper", type="string", length=255, nullable=true)
     */
    private $templateWrapper;

    /**
     * @var string
     *
     * @ORM\Column(name="templateSingle", type="string", length=255, nullable=true)
     */
    private $templateSingle;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneOffice", type="string", length=18, nullable=true)
     */
    private $phoneOffice;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneToll", type="string", length=18, nullable=true)
     */
    private $phoneToll;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneFax", type="string", length=18, nullable=true)
     */
    private $phoneFax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="salutation", type="string", length=255, nullable=true)
     */
    private $salutation;
    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;
    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;
	
    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=255, nullable=true)
     */
    private $shop;
	
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="settings_logo", fileNameProperty="logoGuid")
     * 
     * @var File
     */
    private $logoFile;		
	

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="settings_lPageLogo", fileNameProperty="lPageLogoGuid")
     * 
     * @var File
     */
    private $lPageLogoFile;
	
    /**
     * @var string
     *
     * @ORM\Column(name="lPageLogoGuid", type="string", length=255, nullable=true)
     */
    private $lPageLogoGuid;	
	
    /**
     * @var string
     *
     * @ORM\Column(name="lPageTagLine", type="string", length=255, nullable=true)
     */
    private $lPageTagLine;
	
	
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
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return FormSettings
     */
    public function setUpdateDate()
    {
        $this->updateDate =  new \DateTime("now");;

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
     * Set logoGuid
     *
     * @param string $logoGuid
     * @return FormSettings
     */
    public function setLogoGUID($logoGuid)
    {
        $this->logoGuid = $logoGuid;

        return $this;
    }

    /**
     * Get logoGUID
     *
     * @return string 
     */
    public function getLogoGuid()
    {
        return $this->logoGuid;
    }

	

    /**
     * Set lPageLogoGuid
     *
     * @param string $lPageLogoGuid
     * @return FormSettings
     */
    public function setLPageLogoGUID($lPageLogoGuid)
    {
        $this->lPageLogoGuid = $lPageLogoGuid;

        return $this;
    }

    /**
     * Get lPageLogoGuid
     *
     * @return string 
     */
    public function getLPageLogoGUID()
    {
        return $this->lPageLogoGuid;
    }
	
    /**
     * Set logoText
     *
     * @param string $logoText
     * @return FormSettings
     */
    public function setLogoText($logoText)
    {
        $this->logoText = $logoText;

        return $this;
    }

    /**
     * Get logoText
     *
     * @return string 
     */
    public function getLogoText()
    {
        return $this->logoText;
    }

    /**
     * Set colorLink
     *
     * @param string $colorLink
     * @return FormSettings
     */
    public function setColorLink($colorLink)
    {
        $this->colorLink = $colorLink;

        return $this;
    }

    /**
     * Get colorLink
     *
     * @return string 
     */
    public function getColorLink()
    {
        return $this->colorLink;
    }

    /**
     * Set colorLinkHover
     *
     * @param string $colorLinkHover
     * @return FormSettings
     */
    public function setColorLinkHover($colorLinkHover)
    {
        $this->colorLinkHover = $colorLinkHover;

        return $this;
    }

    /**
     * Get colorLinkHover
     *
     * @return string 
     */
    public function getColorLinkHover()
    {
        return $this->colorLinkHover;
    }

    /**
     * Set colorBackgroundBody
     *
     * @param string $colorBackgroundBody
     * @return FormSettings
     */
    public function setColorBackgroundBody($colorBackgroundBody)
    {
        $this->colorBackgroundBody = $colorBackgroundBody;

        return $this;
    }

    /**
     * Get colorBackgroundBody
     *
     * @return string 
     */
    public function getColorBackgroundBody()
    {
        return $this->colorBackgroundBody;
    }

    /**
     * Set colorBackgroundContent
     *
     * @param string $colorBackgroundContent
     * @return FormSettings
     */
    public function setColorBackgroundContent($colorBackgroundContent)
    {
        $this->colorBackgroundContent = $colorBackgroundContent;

        return $this;
    }

    /**
     * Get colorBackgroundContent
     *
     * @return string 
     */
    public function getColorBackgroundContent()
    {
        return $this->colorBackgroundContent;
    }

    /**
     * Set colorBackgroundFooter
     *
     * @param string $colorBackgroundFooter
     * @return FormSettings
     */
    public function setColorBackgroundFooter($colorBackgroundFooter)
    {
        $this->colorBackgroundFooter = $colorBackgroundFooter;

        return $this;
    }

    /**
     * Get colorBackgroundFooter
     *
     * @return string 
     */
    public function getColorBackgroundFooter()
    {
        return $this->colorBackgroundFooter;
    }

    /**
     * Set colorBackgroundHeader
     *
     * @param string $colorBackgroundHeader
     * @return FormSettings
     */
    public function setColorBackgroundHeader($colorBackgroundHeader)
    {
        $this->colorBackgroundHeader = $colorBackgroundHeader;

        return $this;
    }

    /**
     * Get colorBackgroundHeader
     *
     * @return string 
     */
    public function getColorBackgroundHeader()
    {
        return $this->colorBackgroundHeader;
    }

    /**
     * Set colorTitle
     *
     * @param string $colorTitle
     * @return FormSettings
     */
    public function setColorTitle($colorTitle)
    {
        $this->colorTitle = $colorTitle;

        return $this;
    }

    /**
     * Get colorTitle
     *
     * @return string 
     */
    public function getColorTitle()
    {
        return $this->colorTitle;
    }

    /**
     * Set colorSubtitle
     *
     * @param string $colorSubtitle
     * @return FormSettings
     */
    public function setColorSubtitle($colorSubtitle)
    {
        $this->colorSubtitle = $colorSubtitle;

        return $this;
    }

    /**
     * Get colorSubtitle
     *
     * @return string 
     */
    public function getColorSubtitle()
    {
        return $this->colorSubtitle;
    }

    /**
     * Set colorText
     *
     * @param string $colorText
     * @return FormSettings
     */
    public function setColorText($colorText)
    {
        $this->colorText = $colorText;

        return $this;
    }

    /**
     * Get colorText
     *
     * @return string 
     */
    public function getColorText()
    {
        return $this->colorText;
    }

    /**
     * Set templateWrapper
     *
     * @param string $templateWrapper
     * @return FormSettings
     */
    public function setTemplateWrapper($templateWrapper)
    {
        $this->templateWrapper = $templateWrapper;

        return $this;
    }

    /**
     * Get templateWrapper
     *
     * @return string 
     */
    public function getTemplateWrapper()
    {
        return $this->templateWrapper;
    }

    /**
     * Set templateSingle
     *
     * @param string $templateSingle
     * @return FormSettings
     */
    public function setTemplateSingle($templateSingle)
    {
        $this->templateSingle = $templateSingle;

        return $this;
    }

    /**
     * Get templateSingle
     *
     * @return string 
     */
    public function getTemplateSingle()
    {
        return $this->templateSingle;
    }

    /**
     * Set phoneOffice
     *
     * @param string $phoneOffice
     * @return FormSettings
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
     * Set phoneToll
     *
     * @param string $phoneToll
     * @return FormSettings
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
     * Set phoneFax
     *
     * @param string $phoneFax
     * @return FormSettings
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
     * @return FormSettings
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
     * Set company
     *
     * @param string $company
     * @return FormSettings
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
     * Set salutation
     *
     * @param string $salutation
     * @return FormSettings
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * Get salutation
     *
     * @return string 
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return FormSettings
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }
	
    /**
     * Set shop
     *
     * @param string $shop
     * @return FormSettings
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
	/* 
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $logoFile
     */
    public function setLogoFile(File $image = null)
    {
        $this->logoFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }
	
	
	
	
    /**
     * Set lPageTagLine
     *
     * @param string $lPageTagLine
     * @return FormSettings
     */
    public function setLPageTagLine($lPageTagLine)
    {
        $this->lPageTagLine = $lPageTagLine;

        return $this;
    }

    /**
     * Get lPageTagLine
     *
     * @return string 
     */
    public function getLPageTagLine()
    {
        return $this->lPageTagLine;
    }		
	
	/* 
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $lPageLogoFile
     */
    public function setLPageLogoFile(File $image = null)
    {
        $this->lPageLogoFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getLPageLogoFile()
    {
        return $this->lPageLogoFile;
    }		
}
