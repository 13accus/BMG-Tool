<?php

namespace BMG\BookToolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserExperienceJobLinkType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('experienceJob')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BMG\BookToolBundle\Entity\UserExperienceJobLink'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bmg_booktoolbundle_userexperiencejoblink';
    }
}
