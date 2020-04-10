<?php

namespace App\Controller;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\VisiteType;

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
        return $this->render('formulaires/index.html.twig',$vars);
    }
}
