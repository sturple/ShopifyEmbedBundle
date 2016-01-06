<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TabsMetaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id','hidden')
			->add('productId','hidden')
			->add('title','text')
			->add('type','choice', array(
										'choices' => array('html'=>'HTML', 'snippet'=>'Snippet','content'=>'Content')
										)
			)
			->add('snippet','choice', array(
										'choices'=>array_merge(array('')),
										'required'=>false,
										
										)
			)
			->add('html','textarea', array('required'=>false))
			->add('tabOrder','number')
			->add('save','submit',array('label'=>'Update'))		
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\TabsMeta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_tabsmeta';
    }
}
