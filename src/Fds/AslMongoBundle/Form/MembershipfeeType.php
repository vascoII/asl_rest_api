<?php

namespace Fds\AslMongoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MembershipfeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('year')
            ->add('fee')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fds\AslMongoBundle\Document\Membershipfee'
        ));
    }

    public function getName()
    {
        return 'fds_aslmongobundle_membershipfeetype';
    }
}
