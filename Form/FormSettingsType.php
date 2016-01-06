<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormSettingsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder        
            ->add('logoFile','file', array('required'=> false))
            ->add('logoText',null,array('label'=>'Logo Text','required'=>false))
            ->add('colorLink',null,array('label'=>'Link','required'=>false))
            ->add('colorLinkHover',null,array('label'=>'Link:hover','required'=>false))
            ->add('colorBackgroundBody',null,array('label'=>'Body','required'=>false))
            ->add('colorBackgroundContent',null,array('label'=>'Content','required'=>false))
            ->add('colorBackgroundFooter',null,array('label'=>'Footer','required'=>false))
            ->add('colorBackgroundHeader',null,array('label'=>'Header','required'=>false))
            ->add('colorTitle',null,array('label'=>'Title','required'=>false))
            ->add('colorSubtitle',null,array('label'=>'Subtitle','required'=>false))
            ->add('colorText',null,array('label'=>'Text','required'=>false))
            ->add('phoneOffice',null,array('label'=>'Office','required'=>false))
            ->add('phoneToll',null,array('label'=>'Toll','required'=>false))
            ->add('phoneFax',null,array('label'=>'Fax','required'=>false))
            ->add('email','email',array('label'=>'Email','required'=>false))
            ->add('salutation','textarea',array('label'=>'Salutation','required'=>false))
            ->add('website','url',array('label'=>'Website','required'=>true))
            ->add('lPageLogoFile','file', array('label'=>'Logo','required'=> false))
            ->add('lPageTagLine',null,array('label'=>'Tag Line (header)','required'=>false))
            ->add('company',null,array('label'=>'Company','required'=>false))
            
            ->add('save','submit',array('label'=>'Save'))	
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\FormSettings'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_formsettings';
    }
}
