<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LandingPageQRType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status','choice',array('choices' => array('Active'=>'Active',
                                                            'Disable'=>'Disable',
                                                            'Delete'=>'Delete')))
            ->add('formEnable',null,array('label'=>'Enable Inquiry Form','required'=>false))
            ->add('permalink',null,array('required'=>false))
            ->add('summary','textarea',array('required'=>false,'attr'=>array('rows'=>3)))
            ->add('title',null,array('required'=>false))
            ->add('company',null,array('required'=>false))            
            ->add('logoUrl','url',array('label'=>'Logo Url','required'=>true))
            ->add('buttonUrl','url',array('label'=>'Button Url','required'=>true))
            ->add('phoneOffice',null,array('label'=>'Local','required'=>false))
           
            ->add('phoneToll',null,array('label'=>'Toll-free','required'=>false))           
            ->add('logoFile','file', array('required'=> false))
 
            ->add('pageTitle',null,array('label'=>'Title','required'=>false))
            ->add('youtubeCode',null,array('label'=>'Youtube Code','required'=>false))       
            ->add('youtubeCaption',null,array('label'=>'Video Caption','required'=>false))
            ->add('locatorLink',null,array('label'=>'Store Locator Url','required'=>false))
            ->add('specialOfferImageHorizontalFile','file',array('label'=>'Horizontal Image','required'=>false))           
            ->add('specialOfferImageVerticalFile','file',array('label'=>'Vertical Image','required'=>false))           
            ->add('specialOfferLink',null,array('label'=>'Link','required'=>false))
            ->add('emailEnable',null,array('label'=>'Enable','required'=>false))
            ->add('emailTo','email',array('label'=>'To','required'=>false))
            ->add('emailCc','email',array('label'=>'Cc','required'=>false))
            ->add('emailBcc','email',array('label'=>'Bcc','required'=>false))
            ->add('emailSubject',null,array('label'=>'Subject','required'=>false))            
            ->add('emailMessageHtml',null,array('label'=>'HTML Message','required'=>false,'attr'=>array('rows'=>10)))
            ->add('emailMessageText',null,array('label'=>'Text Message','required'=>false,'attr'=>array('rows'=>10)))
            
            ->add('emailCustomerEnable',null,array('label'=>'Enable','required'=>false))
            ->add('emailCustomerCc','email',array('label'=>'Cc','required'=>false))
            ->add('emailCustomerBcc','email',array('label'=>'Bcc','required'=>false))
            ->add('emailCustomerSubject',null,array('label'=>'Subject','required'=>false))
            ->add('emailCustomerMessageHtml',null,array('label'=>'HTML Message','required'=>false,'attr'=>array('rows'=>10)))
            ->add('emailCustomerMessageText',null,array('label'=>'Text Message','required'=>false,'attr'=>array('rows'=>10)))
            
            ->add('campaignUrl',null,array('label'=>'URL','required'=>false))
            ->add('campaignEmail',null,array('label'=>'Email Code','required'=>false))
            ->add('campaignFirstName',null,array('label'=>'First Name Code','required'=>false))
            ->add('campaignLastName',null,array('label'=>'Last Name Code','required'=>false))
            ->add('save','submit',array('label'=>'Save'))	
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\LandingPage',
            'csrf_protection'=>false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_landingpage';
    }
}
