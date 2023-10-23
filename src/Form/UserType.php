<?php

namespace App\Form;

use App\Entity\Attribute;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('attributes', EntityType::class, [
                'multiple'     => true,
                'required'     => false,
                'autocomplete' => true,
                'class'        => Attribute::class,
                'by_reference' => false,
                'attr'         => [
                    'data-controller' => 'custom-autocomplete',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
