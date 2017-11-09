<?php

namespace Fds\AslMongoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('phone')
            ->add('propertyAsAddress')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('payments')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fds\AslMongoBundle\Document\Owner'
        ));
    }

    public function getName()
    {
        return 'fds_aslmongobundle_ownertype';
    }
}
