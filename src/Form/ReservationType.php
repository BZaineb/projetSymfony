<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class ReservationType extends AbstractType {
    public function buildForm (FormBuilderInterface $builder, array $options){
        $builder->add ('type', ChoiceType::class, [
                'label'=> 'type',
                'choices' => [
                'type visite' => 'visite',
                'type excursion' => 'excursion'
            ]
        ]) 
                ->add ('nbPersonne', IntegerType::class)
                ->add ('categorieHebergement', ChoiceType::class,[
                'choices'=> [
                    '2*'=>'categorie1',
                    '3*'=>'categorie2',
                    '4*'=>'categorie3',
                    '5*'=>'categorie4']
                ])
                ->add('prix', IntegerType::class);

    }   
}