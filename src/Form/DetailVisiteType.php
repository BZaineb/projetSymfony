<?php

namespace App\Form;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DetailExcursionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDebut', DateType::class)
                ->add('dateFin', DateType::class)
                ->add ('excursion', EntityType::class,[
                    'class'=> Visite::class,
                    'query_builder'=> function (VisiteRepository $er){
                        return
                        $er->createQueryBuilder('u')->select('u');
                    },
                    'choice_label'=> function ($x) {
                        return ($x->getNom());
                    }
                    ]);
    }
}
?>