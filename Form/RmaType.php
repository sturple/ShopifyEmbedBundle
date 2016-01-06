<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RmaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('session', 'hidden')
            ->add('status','hidden')            
            ->add('company')
            ->add('firstName')
            ->add('lastName')
            ->add('address1','textarea')
            ->add('address2',null,array('required'=>false))
            ->add('city')
            ->add('postal',null,array('label'=>'Zip/Postal Code'))
            ->add('province',null,array('label'=>'State/Province'))
            ->add('country','country')

            ->add('phoneMobile',null,array('required'=>false))
            ->add('phoneOffice',null,array('required'=>false))
            ->add('phoneFax',null,array('required'=>false))
            ->add('email')
            ->add('notes',null,array('required'=>false))
            ->add('save','submit',array('label'=>'Update'))	
        
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\Rma',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_rma';
    }
}
