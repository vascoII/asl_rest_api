<?php

namespace Fds\AslMongoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('phone')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fds\AslMongoBundle\Document\Resident'
        ));
    }

    public function getName()
    {
        return 'fds_aslmongobundle_residenttype';
    }
}
