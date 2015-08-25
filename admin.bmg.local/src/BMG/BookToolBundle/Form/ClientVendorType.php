<?php

namespace BMG\BookToolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientVendorType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientVendorName')
            ->add('clientVendorAddress1')
            ->add('clientVendorAddress2')
            ->add('clientVendorZipcode')
            ->add('clientVendorLogo')
            ->add('clientVendorWebsite')
            ->add('clientVendorMainPhone')
            ->add('clientVendorMainEmail')
            ->add('clientVendorTimezone')
            ->add('city')
            ->add('status')
            ->add('clientVendorType')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BMG\BookToolBundle\Entity\ClientVendor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bmg_booktoolbundle_clientvendor';
    }
}
