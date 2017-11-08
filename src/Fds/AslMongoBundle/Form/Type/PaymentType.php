<?php

namespace Fds\AslMongoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id')
                ->add('amount')
                ->add('checknumber')
                ->add('banque')
                ->add('checkname')
                ->add('receiptdate')
                ->add('bankingdate')
                ->add('imageurl')
                ->add('membershipfeeId');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Fds\AslMongoBundle\Document\PaymentType',
            'csrf_protection' => false
        ]);
    }


}
