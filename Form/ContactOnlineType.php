<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactOnlineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ip')
            ->add('firstName')
            ->add('lastName')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('province')
            ->add('postal')
            ->add('country')
            ->add('message')
            ->add('utility')
            ->add('fileUploadBlob', 'file')
            ->add('phone')
            ->add('tollPhone')
            ->add('email')           
            ->add('listA')
            ->add('listB')
            ->add('listC')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fgms\ShopifyBundle\Entity\ContactOnline'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fgms_shopifybundle_contactonline';
    }
}
