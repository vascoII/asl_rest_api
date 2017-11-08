<?php

namespace Fds\AslMongoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AslType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id')
                ->add('name')
                ->add('address')
                ->add('postalcode')
                ->add('city')
                ->add('country');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Fds\AslMongoBundle\Document\Asl',
            'csrf_protection' => false
        ]);
    }


}
