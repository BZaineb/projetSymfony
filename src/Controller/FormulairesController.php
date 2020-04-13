<?php

namespace App\Controller;

use App\Entity\Visite;
use App\Form\VisiteType;
use App\Entity\Excursion;
use App\Form\ExcursionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormulairesController extends AbstractController
{
    /**
     * @Route("/formulaires/visite/creation", name="ajout_visite")
     */
    public function formulaireVisiteCreation(Request $request)
    {
        $uneVisite = new Visite();
        $formulaireVisite = $this->createForm(VisiteType::class, $uneVisite, array('action'=>$this->generateUrl("ajout_visite"),'method'=>'POST'));
        $formulaireVisite->handleRequest($request);
        if ($formulaireVisite->isSubmitted() && $formulaireVisite->isValid())
        {
            $fichier = $uneVisite->getPhoto();
            $nomFichierServeur = md5(uniqid()).".".$fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $uneVisite->setPhoto($nomFichierServeur);
            $em = $this->getDoctrine()->getManager();
            $em->persist($uneVisite);
            $em->flush();
            return new Response("fichier uploaded et bd mise à jour");
        }               
        else{
                $vars = ['formulaireVisite'=>$formulaireVisite->createView()];
                return $this->render('formulaires/visite.html.twig',$vars);               
            }
        
    }
    /**
     * @Route("/afficher/visites", name="afficher_visites")
     */
    public function afficherVisite()
    {
        $em = $this->getDoctrine()->getManager();
        $visiteRepo = $em->getRepository(Visite ::class);
        $visites = $visiteRepo->findAll();
        $vars = ['visite'=>$visites];
        return $this->render('front/visite.html.twig', $vars);
    }

    /**
     * @Route("/formulaires/excursion/creation", name="ajout_excursion")
     */
    public function excursionVisiteCreation(Request $request)
    {
        $uneExcursion = new Excursion();
        $formulaireExcursion = $this->createForm(ExcursionType::class, $uneExcursion, array('action'=>$this->generateUrl("ajout_excursion"),'method'=>'POST'));
        $formulaireExcursion->handleRequest($request);
        if ($formulaireExcursion->isSubmitted() && $formulaireExcursion->isValid())
        {
            $fichier = $uneExcursion->getPhoto();
            $nomFichierServeur = md5(uniqid()).".".$fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $uneExcursion->setPhoto($nomFichierServeur);
            $em = $this->getDoctrine()->getManager();
            $em->persist($uneExcursion);
            $em->flush();
            return new Response("fichier uploaded et bd mise à jour");
        }
        else{
            $vars = ['formulaireExcursion'=>$formulaireExcursion->createView()];
            return $this->render('formulaires/excursion.html.twig',$vars);
        }
        
    }
}
