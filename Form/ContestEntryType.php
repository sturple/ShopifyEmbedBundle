<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContestEntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null,array('label'=>'First Name'))
            ->add('lastName', null,array('label'=>'Last Name'))
            ->add('email')
            ->add('location', null,array('required'=> false))
            ->add('description', null,array('required'=> false))
            ->add('photoFile','file', array('required'=> false))
            ->add('photoDate', 'date', array('required'=> false))
            ->add('photoUrl', null,array('required'=> false))
            ->add('terms','hidden')
            ->add('submit','submit',array('label'=>'Submit Contest Entry', 'attr'=>array('class'=>'btn btn-primary btn-lg', 'style'=>'margin-top:24px;')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\ContestEntry',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_contestentry';
    }
}
