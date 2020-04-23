<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class)
                ->add('prenom', TextType::class)
                ->add('pseudo', TextType::class)
                ->add('pays', TextType::class);
                // ->add('plainPassword', PasswordType::class, [
                //     // instead of being set onto the object directly,
                //     // this is read and encoded in the controller
                //     'mapped' => false,
                //     'constraints' => [
                //         new NotBlank([
                //             'message' => 'Please enter a password',
                //         ]),
                //         new Length([
                //             'min' => 6,
                //             'minMessage' => 'Your password should be at least {{ limit }} characters',
                //             // max length allowed by Symfony for security reasons
                //             'max' => 4096,
                //         ]),
                //     ],
                // ]);
        
    }
}