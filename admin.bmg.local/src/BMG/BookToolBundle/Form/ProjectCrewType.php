<?php

namespace BMG\BookToolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectCrewType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projectCrewRating')
            ->add('projectCrewRatingReason')
            ->add('projectCrewContractPassword')
            ->add('projectCrewDatetime')
            ->add('user')
            ->add('projectRole')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BMG\BookToolBundle\Entity\ProjectCrew'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bmg_booktoolbundle_projectcrew';
    }
}
