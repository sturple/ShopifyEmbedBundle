<?php

namespace Fgms\ShopifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LandingPagePartnerStoreType extends AbstractType
{
    var $snippet_choice = array(),
        $collection_choice = array();
    
    public function __construct ($snippet_choice, $collection_choice)
    {
        $this->snippet_choice = $snippet_choice;
        $this->collection_choice = $collection_choice;
    }    
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
            ->add('template','choice',array('choices'=>array('publicQR.html.twig'=>'QR',
                                                             'publicPPC.html.twig'=>'PPC',
                                                             'publicPartnerStore.html.twig'=>'Partner Store')))
            ->add('title',null,array('required'=>false))
            ->add('summary','textarea',array('required'=>false,'attr'=>array('rows'=>3)))
            ->add('announcement','textarea',array('required'=>false,'attr'=>array('rows'=>15),'label'=>'Announcements'))
            ->add('permalink',null,array('required'=>false))
            ->add('company',null,array('required'=>false,'label'=>'Organization')) 
            ->add('logoFile','file', array('required'=> false))
            ->add('backgroundFile','file', array('required'=> false))
            ->add('specialOfferImageHorizontalFile','file',array('label'=>'Feature Image','required'=>false))              
            ->add('pageTitle',null,array('label'=>'Title','required'=>false))
            ->add('pageSubtitle',null,array('label'=>'Subtitle','required'=>false))
            ->add('content','textarea',array('required'=>false,'attr'=>array('rows'=>15),'label'=>'Main Content'))
            ->add('sidebarContent','textarea',array('required'=>false,'attr'=>array('rows'=>15),'label'=>'Sidebar Content'))
            
            ->add('collectiona','choice',array('required'=>false,
                                               'choices'=>$this->collection_choice,
                                               'label'=>'Feature Collection'
                                               )
                  ) 
            ->add('collectionb','choice',array('required'=>false,
                                               'choices'=>$this->collection_choice,
                                               'label'=>'Secondary Collection'
                                               )
                  )
            
            ->add('postContent','choice', array(
                                        'choices'=>$this->snippet_choice,
                                        'required'=>false,
                                        'label'=>'Post Content'
                                        )
            )            
            ->add('specialOfferLink',null,array('label'=>'Link','required'=>false))            
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
