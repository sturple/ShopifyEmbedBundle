<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RmaItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
        ->add('session')
        ->add('toolType',null,array('label'=>'Tool','required'=>false))
        ->add('toolBrand',null,array('label'=>'Brand','required'=>false))
        ->add('toolRepairNotes',null,array('label'=>'Notes','required'=>false))				
        ->add('status')
        ->add('save','submit',array('label'=>'Update'))	
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\RmaItem',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_rmaitem';
    }
}
