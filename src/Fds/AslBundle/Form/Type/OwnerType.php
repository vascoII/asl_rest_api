<?php

namespace Fds\AslBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OwnerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName')
                ->add('lastName')
                ->add('email')
                ->add('phone')
                ->add('propertyAsAdress')
                ->add('address')
                ->add('postalCode')
                ->add('city')
                ->add('country');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Fds\AslBundle\Entity\Owner',
            'csrf_protection' => false
        ]);
    }


}
