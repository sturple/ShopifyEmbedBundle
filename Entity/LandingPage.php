<?php
namespace Fgms\ShopifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * LandingPage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Vich\Uploadable
 */
class LandingPage
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
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="permalink", type="string", length=255, nullable=true)
     */
    private $permalink;

    /**
     * @var string
     *
     * @ORM\Column(name="pageSubtitle", type="string", length=255, nullable=true)
     */
    private $pageSubtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="announcement", type="text", nullable=true)
     */
    private $announcement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="announcementStartDate", type="datetime", nullable=true)
     */
	private $announcementStartDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="announcementEndDate", type="datetime", nullable=true)
     */
	private $announcementEndDate;

    /**
     * @var string
     *
     * @ORM\Column(name="postContent", type="text", nullable=true)
     */

    private $postContent;

    /**
     * @var string
     *
     * @ORM\Column(name="collectiona", type="string", length=255, nullable=true)
     */
    private $collectiona;

    /**
     * @var string
     *
     * @ORM\Column(name="collectionb", type="string", length=255, nullable=true)
     */
    private $collectionb;

    /**
     * @var string
     *
     * @ORM\Column(name="sidebarContent", type="text", nullable=true)
     */
    private $sidebarContent;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255, nullable=true)
     */
    private $template;
    /**
     * @var string
     *
     * @ORM\Column(name="templateOverride", type="string", length=255, nullable=true)
     */
    private $templateOverride;
    /**
     * @var string
     *
     * @ORM\Column(name="logoUrl", type="string", length=255, nullable=true)
     */
    private $logoUrl;
    /**
     * @var string
     *
     * @ORM\Column(name="buttonUrl", type="string", length=255, nullable=true)
     */
    private $buttonUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneOffice", type="string", length=100, nullable=true)
     */
    private $phoneOffice;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneFax", type="string", length=100, nullable=true)
     */
    private $phoneFax;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneToll", type="string", length=100, nullable=true)
     */
    private $phoneToll;

    /**
     * @var string
     *
     * @ORM\Column(name="logoGuid", type="string", length=255, nullable=true)
     *
     *
     */
    private $logoGuid;

    /**
     * @var string
     *
     * @ORM\Column(name="youtubeTitle", type="string", length=255, nullable=true)
     */
    private $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="youtubeCode", type="string", length=255, nullable=true)
     */
    private $youtubeCode;

    /**
     * @var string
     *
     * @ORM\Column(name="youtubeThumbGuid", type="string", length=255, nullable=true)
     */
    private $youtubeThumbGuid;

    /**
     * @var string
     *
     * @ORM\Column(name="youtubeCaption", type="string", length=255, nullable=true)
     */
    private $youtubeCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="locatorLink", type="string", length=255, nullable=true)
     */
    private $locatorLink;

    /**
     * @var string
     *
     * @ORM\Column(name="specialOfferImageHorizontalGuid", type="string", length=255, nullable=true)
     */
    private $specialOfferImageHorizontalGuid;

    /**
     * @var string
     *
     * @ORM\Column(name="specialOfferImageVerticalGuid", type="string", length=255, nullable=true)
     */
    private $specialOfferImageVerticalGuid;


    /**
     * @var string
     *
     * @ORM\Column(name="specialOfferLink", type="string", length=255, nullable=true)
     */
    private $specialOfferLink;

    /**
     * @var string
     *
     * @ORM\Column(name="emailTo", type="string", length=255, nullable=true)
     */
    private $emailTo;

    /**
     * @var string
     *
     * @ORM\Column(name="emailCc", type="string", length=255, nullable=true)
     */
    private $emailCc;

    /**
     * @var string
     *
     * @ORM\Column(name="emailBcc", type="string", length=255, nullable=true)
     */
    private $emailBcc;

    /**
     * @var string
     *
     * @ORM\Column(name="emailSubject", type="string", length=255, nullable=true)
     */
    private $emailSubject;

    /**
     * @var string
     *
     * @ORM\Column(name="emailMessageHtml", type="text", nullable=true)
     */
    private $emailMessageHtml;
    /**
     * @var string
     *
     * @ORM\Column(name="emailMessageText", type="text", nullable=true)
     */
    private $emailMessageText;
    /**
     * @var string
     *
     * @ORM\Column(name="emailCustomerCc", type="string", length=255, nullable=true)
     */
    private $emailCustomerCc;

    /**
     * @var string
     *
     * @ORM\Column(name="emailCustomerBcc", type="string", length=255, nullable=true)
     */
    private $emailCustomerBcc;

    /**
     * @var string
     *
     * @ORM\Column(name="emailCustomerSubject", type="string", length=255, nullable=true)
     */
    private $emailCustomerSubject;

    /**
     * @var string
     *
     * @ORM\Column(name="emailCustomerMessageHtml", type="text", nullable=true)
     */
    private $emailCustomerMessageHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="emailCustomerMessageText", type="text", nullable=true)
     */
    private $emailCustomerMessageText;

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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="lp_logo", fileNameProperty="logoGuid")
     *
     * @var File
     */
    private $logoFile;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="lp_background_image", fileNameProperty="backgroundGuid")
     *
     * @var File
     */
    private $backgroundFile;

    /**
     * @var string
     *
     * @ORM\Column(name="backgroundGuid", type="string", length=255, nullable=true)
     *
     *
     */
    private $backgroundGuid;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="lp_youtube_thumb", fileNameProperty="youtubeThumbGuid")
     *
     * @var File
     */
    private $youtubeThumbFile;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="lp_special_horizontal", fileNameProperty="specialOfferImageHorizontalGuid")
     *
     * @var File
     */
    private $specialOfferImageHorizontalFile;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="lp_special_vertical", fileNameProperty="specialOfferImageVerticalGuid")
     *
     * @var File
     */
    private $specialOfferImageVerticalFile;
    /**
     * @var boolean
     *
     * @ORM\Column(name="formEnable", type="boolean", nullable=true)
     */
    private $formEnable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailEnable", type="boolean", nullable=true)
     */
    private $emailEnable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailCustomerEnable", type="boolean", nullable=true)
     */
    private $emailCustomerEnable;

    /**
     * @var string
     *
     * @ORM\Column(name="campaignUrl", type="string", length=255, nullable=true)
     */
    private $campaignUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="campaignEmail", type="string", length=255, nullable=true)
     */
    private $campaignEmail;
    /**
     * @var string
     *
     * @ORM\Column(name="campaignFirstName", type="string", length=255, nullable=true)
     */
    private $campaignFirstName;
    /**
     * @var string
     *
     * @ORM\Column(name="campaignLastName", type="string", length=255, nullable=true)
     */
    private $campaignLastName;

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
     * Set title
     *
     * @param string $title
     * @return LandingPage
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
     * @return LandingPage
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
     * Set company
     *
     * @param string $company
     * @return LandingPage
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
     * Set status
     *
     * @param string $status
     * @return LandingPage
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return LandingPage
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
    }
    /**
     * Set pageSubtitle
     *
     * @param string $pageSubtitle
     * @return LandingPage
     */
    public function setPageSubtitle($subtitle)
    {
        $this->pageSubtitle = $subtitle;
        return $this;
    }

    /**
     * Get pageSubtitle
     *
     * @return string
     */
    public function getPageSubtitle()
    {
        return $this->pageSubtitle;
    }
    /**
     * Set summary
     *
     * @param string $summary
     * @return LandingPage
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
    /**
     * Set content
     *
     * @param string $content
     * @return LandingPage
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
     * Set announcement
     *
     * @param string $announcement
     * @return LandingPage
     */
    public function setAnnouncement($announcement)
    {
        $this->announcement = $announcement;
        return $this;
    }
    /**
     * Get announcement
     *
     * @return string
     */
    public function getAnnouncement()
    {
        return $this->announcement;
    }

    /**
     * Set postContent
     *
     * @param string $postContent
     * @return LandingPage
     */
    public function setPostContent($content)
    {
        $this->postContent = $content;
        return $this;
    }
    /**
     * Get postContent
     *
     * @return string
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Set collectiona
     *
     * @param string $collectiona
     * @return LandingPage
     */
    public function setCollectiona($collection)
    {
        $this->collectiona = $collection;
        return $this;
    }

    /**
     * Get collectiona
     *
     * @return string
     */
    public function getCollectiona()
    {
        return $this->collectiona;
    }

     /**
     * Set collectionb
     *
     * @param string $collectionb
     * @return LandingPage
     */
    public function setCollectionb($collection)
    {
        $this->collectionb = $collection;
        return $this;
    }

    /**
     * Get collectionb
     *
     * @return string
     */
    public function getCollectionb()
    {
        return $this->collectionb;
    }
    /**
     * Get sidebarContent
     *
     * @return string
     */
    public function getSidebarContent()
    {
        return $this->sidebarContent;
    }

    /**
     * Set sidebarContent
     *
     * @param string $sidebarContent
     * @return LandingPage
     */
    public function setSidebarContent($content)
    {
        $this->sidebarContent = $content;
        return $this;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return LandingPage
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

/**
 * Set templateOverride
 *
 * @param string $templateOverride
 * @return LandingPage
 */
public function setTemplateOverride($templateOverride)
{
    $this->templateOverride = $templateOverride;
    return $this;
}
/**
 * Get templateOverride
 *
 * @return string
 */
public function getTemplateOverride()
{
    return $this->templateOverride;
}


    /**
     * Set logoUrl
     *
     * @param string $logoUrl
     * @return LandingPage
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    /**
     * Get logoUrl
     *
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }
    /**
     * Set buttonUrl
     *
     * @param string $buttonUrl
     * @return LandingPage
     */
    public function setButtonUrl($buttonUrl)
    {
        $this->buttonUrl = $buttonUrl;
        return $this;
    }

    /**
     * Get buttonUrl
     *
     * @return string
     */
    public function getButtonUrl()
    {
        return $this->buttonUrl;
    }

    /**
     * Set phoneOffice
     *
     * @param string $phoneOffice
     * @return LandingPage
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
     * @return LandingPage
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
     * Set phoneToll
     *
     * @param string $phoneToll
     * @return LandingPage
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
     * Set logoGuid
     *
     * @param string $logoGuid
     * @return LandingPage
     */
    public function setLogoGuid($logoGuid)
    {
        $this->logoGuid = $logoGuid;
        return $this;
    }

    /**
     * Get logoGuid
     *
     * @return string
     */
    public function getLogoGuid()
    {
        return $this->logoGuid;
    }


   /**
     * Set backgroundGuid
     *
     * @param string $backgroundGuid
     * @return LandingPage
     */
    public function setBackgroundGuid($guid)
    {
        $this->backgroundGuid = $guid;
        return $this;
    }

    /**
     * Get backgroundGuid
     *
     * @return string
     */
    public function getBackgroundGuid()
    {
        return $this->backgroundGuid;
    }

    /**
     * Set pageTitle
     *
     * @param string $pageTitle
     * @return LandingPage
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }

    /**
     * Get pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set youtubeCode
     *
     * @param string $youtubeCode
     * @return LandingPage
     */
    public function setYoutubeCode($youtubeCode)
    {
        $this->youtubeCode = $youtubeCode;
        return $this;
    }

    /**
     * Get youtubeCode
     *
     * @return string
     */
    public function getYoutubeCode()
    {
        return $this->youtubeCode;
    }

    /**
     * Set youtubeThumbGuid
     *
     * @param string $youtubeThumbGuid
     * @return LandingPage
     */
    public function setYoutubeThumbGuid($youtubeThumbGuid)
    {
        $this->youtubeThumbGuid = $youtubeThumbGuid;

        return $this;
    }

    /**
     * Get youtubeThumbGuid
     *
     * @return string
     */
    public function getYoutubeThumbGuid()
    {
        return $this->youtubeThumbGuid;
    }

    /**
     * Set youtubeThumbBlob
     *
     * @param string $youtubeThumbBlob
     * @return LandingPage
     */
    public function setYoutubeThumbBlob($youtubeThumbBlob)
    {
        $this->youtubeThumbBlob = $youtubeThumbBlob;
        return $this;
    }

    /**
     * Get youtubeThumbBlob
     *
     * @return string
     */
    public function getYoutubeThumbBlob()
    {
        return $this->youtubeThumbBlob;
    }

    /**
     * Set youtubeCaption
     *
     * @param string $youtubeCaption
     * @return LandingPage
     */
    public function setYoutubeCaption($youtubeCaption)
    {
        $this->youtubeCaption = $youtubeCaption;
        return $this;
    }

    /**
     * Get youtubeCaption
     *
     * @return string
     */
    public function getYoutubeCaption()
    {
        return $this->youtubeCaption;
    }

    /**
     * Set locatorLink
     *
     * @param string $locatorLink
     * @return LandingPage
     */
    public function setLocatorLink($locatorLink)
    {
        $this->locatorLink = $locatorLink;
        return $this;
    }

    /**
     * Get locatorLink
     *
     * @return string
     */
    public function getLocatorLink()
    {
        return $this->locatorLink;
    }

    /**
     * Set specialOfferImageHorizontalGuid
     *
     * @param string $specialOfferImageHorizontalGuid
     * @return LandingPage
     */
    public function setSpecialOfferImageHorizontalGuid($specialOfferImageHorizontalGuid)
    {
        $this->specialOfferImageHorizontalGuid = $specialOfferImageHorizontalGuid;
        return $this;
    }

    /**
     * Get specialOfferImageHorizontalGuid
     *
     * @return string
     */
    public function getSpecialOfferImageHorizontalGuid()
    {
        return $this->specialOfferImageHorizontalGuid;
    }

    /**
     * Set specialOfferImageHorizontalBlob
     *
     * @param string $specialOfferImageHorizontalBlob
     * @return LandingPage
     */
    public function setSpecialOfferImageHorizontalBlob($specialOfferImageHorizontalBlob)
    {
        $this->specialOfferImageHorizontalBlob = $specialOfferImageHorizontalBlob;
        return $this;
    }

    /**
     * Get specialOfferImageHorizontalBlob
     *
     * @return string
     */
    public function getSpecialOfferImageHorizontalBlob()
    {
        return $this->specialOfferImageHorizontalBlob;
    }

    /**
     * Set specialOfferImageVerticalGuid
     *
     * @param string $specialOfferImageVerticalGuid
     * @return LandingPage
     */
    public function setSpecialOfferImageVerticalGuid($specialOfferImageVerticalGuid)
    {
        $this->specialOfferImageVerticalGuid = $specialOfferImageVerticalGuid;
        return $this;
    }

    /**
     * Get specialOfferImageVerticalGuid
     *
     * @return string
     */
    public function getSpecialOfferImageVerticalGuid()
    {
        return $this->specialOfferImageVerticalGuid;
    }

    /**
     * Set specialOfferImageVerticalBlob
     *
     * @param string $specialOfferImageVerticalBlob
     * @return LandingPage
     */
    public function setSpecialOfferImageVerticalBlob($specialOfferImageVerticalBlob)
    {
        $this->specialOfferImageVerticalBlob = $specialOfferImageVerticalBlob;
        return $this;
    }

    /**
     * Get specialOfferImageVerticalBlob
     *
     * @return string
     */
    public function getSpecialOfferImageVerticalBlob()
    {
        return $this->specialOfferImageVerticalBlob;
    }

    /**
     * Set specialOfferLink
     *
     * @param string $specialOfferLink
     * @return LandingPage
     */
    public function setSpecialOfferLink($specialOfferLink)
    {
        $this->specialOfferLink = $specialOfferLink;
        return $this;
    }

    /**
     * Get specialOfferLink
     *
     * @return string
     */
    public function getSpecialOfferLink()
    {
        return $this->specialOfferLink;
    }

   /**
     * Set formEnable
     *
     * @param boolean $formEnable
     * @return LandingPageInquiry
     */
    public function setFormEnable($formEnable)
    {
        $this->formEnable = $formEnable;
        return $this;
    }

    /**
     * Get formEnable
     *
     * @return boolean
     */
    public function getFormEnable()
    {
        return $this->formEnable;
    }
    /**
     * Set emailEnable
     *
     * @param boolean $emailEnable
     * @return LandingPageInquiry
     */
    public function setEmailEnable($emailEnable)
    {
        $this->emailEnable = $emailEnable;
        return $this;
    }

    /**
     * Get emailEnable
     *
     * @return boolean
     */
    public function getEmailEnable()
    {
        return $this->emailEnable;
    }
    /**
     * Set emailTo
     *
     * @param string $emailTo
     * @return LandingPage
     */
    public function setEmailTo($emailTo)
    {
        $this->emailTo = $emailTo;
        return $this;
    }

    /**
     * Get emailTo
     *
     * @return string
     */
    public function getEmailTo()
    {
        return $this->emailTo;
    }

    /**
     * Set emailCc
     *
     * @param string $emailCc
     * @return LandingPage
     */
    public function setEmailCc($emailCc)
    {
        $this->emailCc = $emailCc;
        return $this;
    }

    /**
     * Get emailCc
     *
     * @return string
     */
    public function getEmailCc()
    {
        return $this->emailCc;
    }

    /**
     * Set emailBcc
     *
     * @param string $emailBcc
     * @return LandingPage
     */
    public function setEmailBcc($emailBcc)
    {
        $this->emailBcc = $emailBcc;
        return $this;
    }

    /**
     * Get emailBcc
     *
     * @return string
     */
    public function getEmailBcc()
    {
        return $this->emailBcc;
    }

    /**
     * Set emailSubject
     *
     * @param string $emailSubject
     * @return LandingPage
     */
    public function setEmailSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;
        return $this;
    }

    /**
     * Get emailSubject
     *
     * @return string
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     * Set emailMessageHtml
     *
     * @param string $emailMessage
     * @return LandingPage
     */
    public function setEmailMessageHtml($emailMessage)
    {
        $this->emailMessageHtml = $emailMessage;
        return $this;
    }

    /**
     * Get emailMessageHtml
     *
     * @return string
     */
    public function getEmailMessageHtml()
    {
        return $this->emailMessageHtml;
    }
    /**
     * Set emailMessageText
     *
     * @param string $emailMessage
     * @return LandingPage
     */
    public function setEmailMessageText($emailMessage)
    {
        $this->emailMessageText = $emailMessage;
        return $this;
    }

    /**
     * Get emailMessageText
     *
     * @return string
     */
    public function getEmailMessageText()
    {
        return $this->emailMessageText;
    }


    /**
     * Set emailCustomerEnable
     *
     * @param boolean $emailCustomerEnable
     * @return LandingPageInquiry
     */
    public function setEmailCustomerEnable($emailCustomerEnable)
    {
        $this->emailCustomerEnable = $emailCustomerEnable;
        return $this;
    }

    /**
     * Get customerEmailEnable
     *
     * @return boolean
     */
    public function getEmailCustomerEnable()
    {
        return $this->emailCustomerEnable;
    }

    /**
     * Set emailCustomerCc
     *
     * @param string $emailCustomerCc
     * @return LandingPage
     */
    public function setEmailCustomerCc($emailCustomerCc)
    {
        $this->emailCustomerCc = $emailCustomerCc;
        return $this;
    }

    /**
     * Get emailCustomerCc
     *
     * @return string
     */
    public function getEmailCustomerCc()
    {
        return $this->emailCustomerCc;
    }

    /**
     * Set emailCustomerBcc
     *
     * @param string $emailCustomerBcc
     * @return LandingPage
     */
    public function setEmailCustomerBcc($emailCustomerBcc)
    {
        $this->emailCustomerBcc = $emailCustomerBcc;
        return $this;
    }

    /**
     * Get emailCustomerBcc
     *
     * @return string
     */
    public function getEmailCustomerBcc()
    {
        return $this->emailCustomerBcc;
    }

    /**
     * Set emailCustomerSubject
     *
     * @param string $emailCustomerSubject
     * @return LandingPage
     */
    public function setEmailCustomerSubject($emailCustomerSubject)
    {
        $this->emailCustomerSubject = $emailCustomerSubject;
        return $this;
    }

    /**
     * Get emailCustomerSubject
     *
     * @return string
     */
    public function getEmailCustomerSubject()
    {
        return $this->emailCustomerSubject;
    }

    /**
     * Set emailCustomerMessageHtml
     *
     * @param string $emailCustomerMessage
     * @return LandingPage
     */
    public function setEmailCustomerMessageHtml($emailCustomerMessage)
    {
        $this->emailCustomerMessageHtml = $emailCustomerMessage;
        return $this;
    }

    /**
     * Get emailCustomerMessageHtml
     *
     * @return string
     */
    public function getEmailCustomerMessageHtml()
    {
        return $this->emailCustomerMessageHtml;
    }


    /**
     * Set emailCustomerMessageText
     *
     * @param string $emailCustomerMessage
     * @return LandingPage
     */
    public function setEmailCustomerMessageText($emailCustomerMessage)
    {
        $this->emailCustomerMessageText = $emailCustomerMessage;
        return $this;
    }

    /**
     * Get emailCustomerMessageText
     *
     * @return string
     */
    public function getEmailCustomerMessageText()
    {
        return $this->emailCustomerMessageText;
    }


    /**
     * Set shop
     *
     * @param string $shop
     * @return LandingPage
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
     * @return LandingPage
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
     * @return LandingPage
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
     * Set updateDate
     *
     * @param \DateTime $announcementStartDate
     * @return LandingPage
     */
    public function setAnnouncementStartDate($date="now")
    {
        $this->announcementStartDate =  new \DateTime($date);
        return $this;
    }

    /**
     * Get announcementStartDate
     *
     * @return \DateTime
     */
    public function getAnnouncementStartDate()
    {
        return $this->announcementStartDate;
    }

  /**
     * Set updateDate
     *
     * @param \DateTime $announcementStartDate
     * @return LandingPage
     */
    public function setAnnouncementEndDate($date="now")
    {
        $this->announcementEndDate =  new \DateTime($date);
        return $this;
    }

    /**
     * Get announcementStartDate
     *
     * @return \DateTime
     */
    public function getAnnouncementEndDate()
    {
        return $this->announcementEndDate;
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
    public function getBackgroundFile()
    {
        return $this->backgroundFile;
    }

	/*
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $backgroundFile
     */
    public function setBackgroundFile(File $image = null)
    {
        $this->backgroundFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

	/*
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $youtubeThumbFile
     */
    public function setyoutubeThumbFile(File $image = null)
    {
        $this->youtubeThumbFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getYoutubeThumbFile()
    {
        return $this->youtubeThumbFile;
    }



	/*
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $specialOfferImageVerticalFile
     */
    public function setSpecialOfferImageVerticalFile(File $image = null)
    {
        $this->specialOfferImageVerticalFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getSpecialOfferImageVerticalFile()
    {
        return $this->specialOfferImageVerticalFile;
    }


	/*
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $specialOfferImageHorizontalFile
     */
    public function setSpecialOfferImageHorizontalFile(File $image = null)
    {
        $this->specialOfferImageHorizontalFile = $image;
        if ($image) { $this->setUpdateDate();  }
    }

    /**
     * @return File
     */
    public function getSpecialOfferImageHorizontalFile()
    {
        return $this->specialOfferImageHorizontalFile;
    }






    /**
     * Set campaignUrl
     *
     * @param string $campaignUrl
     * @return LandingPage
     */
    public function setCampaignUrl($campaignUrl)
    {
        $this->campaignUrl = $campaignUrl;

        return $this;
    }

    /**
     * Get campaignUrl
     *
     * @return string
     */
    public function getCampaignUrl()
    {
        return $this->campaignUrl;
    }

    /**
     * Set campaignEmail
     *
     * @param string $campaignEmail
     * @return LandingPage
     */
    public function setCampaignEmail($campaignEmail)
    {
        $this->campaignEmail = $campaignEmail;

        return $this;
    }

    /**
     * Get campaignEmail
     *
     * @return string
     */
    public function getCampaignEmail()
    {
        return $this->campaignEmail;
    }
    /**
     * Set campaignFirstName
     *
     * @param string $campaignFirstName
     * @return LandingPage
     */
    public function setCampaignFirstName($campaignFirstName)
    {
        $this->campaignFirstName = $campaignFirstName;

        return $this;
    }

    /**
     * Get campaignFirstName
     *
     * @return string
     */
    public function getCampaignFirstName()
    {
        return $this->campaignFirstName;
    }
    /**
     * Set campaignLastName
     *
     * @param string $campaignLastName
     * @return LandingPage
     */
    public function setCampaignLastName($campaignLastName)
    {
        $this->campaignLastName = $campaignLastName;

        return $this;
    }

    /**
     * Get campaignLastName
     *
     * @return string
     */
    public function getCampaignLastName()
    {
        return $this->campaignLastName;
    }
}
