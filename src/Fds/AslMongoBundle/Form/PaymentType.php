<?php

namespace Fds\AslMongoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('amount')
            ->add('paymentType')
            ->add('checkNumber')
            ->add('banque')
            ->add('checkName')
            ->add('receiptDate')
            ->add('bankingDate')
            ->add('imageUrl')
            ->add('membershipfeeId')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fds\AslMongoBundle\Document\Payment'
        ));
    }

    public function getName()
    {
        return 'fds_aslmongobundle_paymenttype';
    }
}
