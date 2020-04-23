<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    /**
     * @Route ("/demande/devis", name="demande_devis");
     */
    public function demandeDevis (Request $request){
        $unDevis = new Reservation();
        // on crée le formulaire du type souhaité
        $formulaireDevis = $this->createForm (ReservationType::class,$unDevis, array('action' => $this->generateUrl("demande_devis"), 'method' => 'POST'));
        $formulaireDevis->handleRequest($request);
        // dd($formulaireDevis);
        if ($formulaireDevis->isSubmitted() && $formulaireDevis->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unDevis);
            $em->flush();
            return new Response('votre devis a été envoyé');
        }else{
            // on envoie un objet FormView à la vue pour qu'elle puisse 
            // faire le rendu, pas le formulaire en soi
            $vars = ['devis'=>$formulaireDevis->createView()];
            
            return $this->render ('/accueil/devis.html.twig', $vars);
            // $vars = ['devis' => $formulaireDevis->createView()];
            
            // return $this->render ('/accueil/index.html.twig', $vars);
        }      
    }  
}
