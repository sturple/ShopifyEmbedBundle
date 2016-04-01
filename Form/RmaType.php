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
            ->add('address1','textarea',array('label'=>'Address 1'))
            ->add('address2',null,array('required'=>false,'label'=>'Address 2'))
            ->add('city')
            ->add('postal',null,array('label'=>'Zip/Postal'))
            ->add('province',null,array('label'=>'State/Province'))
            ->add('country','country',array('preferred_choices'=>array('US')))

            ->add('phoneMobile',null,array('required'=>false))
            ->add('phoneOffice',null,array('required'=>false))
            ->add('phoneFax',null,array('required'=>false))
            ->add('email')
            ->add('notes',null,array('required'=>false))
            ->add('save','submit',array('label'=>'Proceed to Step 2', 'attr'=>array('class'=>'btn-lg btn-primary btn btn-advance')))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\Customers',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_customers';
    }
}
