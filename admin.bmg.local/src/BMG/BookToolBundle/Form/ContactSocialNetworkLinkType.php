<?php

namespace BMG\BookToolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactSocialNetworkLinkType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactSocialNetworkLinkAccount')
            ->add('contactSocialNetworkLinkDatetime')
            ->add('socialNetwork')
            ->add('contact')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BMG\BookToolBundle\Entity\ContactSocialNetworkLink'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bmg_booktoolbundle_contactsocialnetworklink';
    }
}
