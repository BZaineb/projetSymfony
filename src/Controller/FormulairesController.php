<?php

namespace App\Controller;

use App\Entity\Visite;
use App\Form\VisiteType;
use App\Entity\Excursion;
use App\Form\ExcursionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulairesController extends AbstractController
{
    /**
     * @Route("/formulaires/visite/creation", name="ajout_visite")
     */
    public function formulaireVisiteCreation()
    {
        $uneVisite = new Visite();
        $formulaireVisite = $this->createForm(VisiteType::class, $uneVisite, array('action'=>$this->generateUrl("ajout_visite"),'method'=>'POST'));
        $vars = ['formulaireVisite'=>$formulaireVisite->createView()];
        return $this->render('formulaires/visite.html.twig',$vars);
    }
    /**
     * @Route("/formulaires/excursion/creation", name="ajout_excursion")
     */
    public function excursionVisiteCreation()
    {
        $uneExcursion = new Excursion();
        $formulaireExcursion = $this->createForm(ExcursionType::class, $uneExcursion, array('action'=>$this->generateUrl("ajout_excursion"),'method'=>'POST'));
        $vars = ['formulaireExcursion'=>$formulaireExcursion->createView()];
        return $this->render('formulaires/excursion.html.twig',$vars);
    }
}
