<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LandingPageInquiryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder            
            ->add('firstName',null,array('required'=>false))
            ->add('lastName',null,array('required'=>false))
            ->add('email','email')
            ->add('message')
            ->add('list1',null,array('required'=>false, 'label'=>'Subscribe for Special Offers  '))
            ->add('save','submit',array('label'=>'Send Message'))	
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\LandingPageInquiry',
            'csrf_protection'=>false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_landingpageinquiry';
    }
}
