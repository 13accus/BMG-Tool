<?php

namespace BMG\BookToolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userEmail')
            ->add('userPassword')
            ->add('userSmsVerificationCode')
            ->add('userFirstname')
            ->add('userLastname')
            ->add('userAddress1')
            ->add('userAddress2')
            ->add('userZipcode')
            ->add('userMobile')
            ->add('userHalfDay')
            ->add('userWillingToTravel')
            ->add('userWebsite')
            ->add('userNotes')
            ->add('userIp')
            ->add('userCreateDatetime')
            ->add('userLastupdateDatetime')
            ->add('userGender')
            ->add('userBio')
            ->add('userPhoto')
            ->add('userAdmin')
            ->add('status')
            ->add('hearAbout')
            ->add('city')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BMG\BookToolBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bmg_booktoolbundle_user';
    }
}
