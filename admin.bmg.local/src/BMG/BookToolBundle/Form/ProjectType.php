<?php

namespace BMG\BookToolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projectName')
            ->add('projectDatetimeStart')
            ->add('projectDatetimeEnd')
            ->add('projectAirDatetimeStart')
            ->add('projectAirDatetimeEnd')
            ->add('projectSetupStagingDatetimeStart')
            ->add('projectSetupStagingDatetimeEnd')
            ->add('projectSetupDatetimeStart')
            ->add('projectSetupDatetimeEnd')
            ->add('projectShootDatetimeStart')
            ->add('projectShootDatetimeEnd')
            ->add('projectLoadOutDatetimeStart')
            ->add('projectLoadOutDatetimeEnd')
            ->add('projectLocation')
            ->add('projectAddress1')
            ->add('projectAddress2')
            ->add('projectZipcode')
            ->add('status')
            ->add('city')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BMG\BookToolBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bmg_booktoolbundle_project';
    }
}
