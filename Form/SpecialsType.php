<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpecialsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('publishDate', 'date')
            ->add('unpublishDate','date')
            ->add('title')
            ->add('subtitle', null,array('required'=> false))
            ->add('content')
            ->add('buttonText', null,array('required'=> false))
            ->add('url', null,array('required'=> false))
            ->add('productURL','hidden',array('required'=> false))
            ->add('collectionURL','hidden',array('required'=> false))
            ->add('pageURL','hidden',array('required'=> false))
            ->add('imageFile','file', array('required'=> false))            
            ->add('permalink',null,array('required'=> false))
            ->add('shortlink', null,array('required'=> false))
            ->add('shortlinkEnable', null,array('required'=> false))
            ->add('save','submit',array('label'=>'Save'))	
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\Specials'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_specials';
    }
}
