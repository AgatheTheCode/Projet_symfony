<?php
// src/Form/LoginType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Log in'
            ])
            ->add('rememberMe', CheckboxType::class, [
                'label' => 'Remember me',
                'required' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // configure your form options here
        ]);
    }
}
