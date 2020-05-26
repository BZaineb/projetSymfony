<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Entity\DetailExcursion;
use App\Form\DetailExcursionType;
use Symfony\Component\HttpClient\HttpClient;
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
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(User::class);
        $userConnecte = $this->getUser();
        $profil = $rep->find($userConnecte->getId());
        $vars = ['profil' => $profil];
        return $this->render('accueil/profil.html.twig', $vars);
    }
    /**
     * @Route("/", name="meteo")
     */
    public function meteo()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=Marrakech,Morocco&units=metric&appid=7781f04cd5015c433d348665c021f6b3');
        $content = $response->toArray();

        $weather = $content["weather"][0]["main"];
        $weatherIcon = $content["weather"][0]["icon"];
        $temp = $content["main"]["temp"];
        $wind = $content["wind"]["speed"];
        $today = date("m.d.y"); 
       
        $vars = ["weather" => $weather];
        $vars["weatherIcon"] = $weatherIcon;
        $vars["temp"] = $temp;
        $vars["wind"]  = $wind;
        $vars["today"]  = $today;
        return $this->render('accueil/index.html.twig', $vars);
    }
    /**
     * @Route ("/demande/devis", name="demande_devis");
     */
    public function demandeDevis (Request $request){
        $unDevis = new Reservation();
        $unDevis->setUser($this->getUser());
        // ici je récupère les données excursions
        // $em = $this->getDoctrine()->getManager();
        // $excursionRepo = $em->getRepository(Excursion::class);
        //je récupère l'excursion choisi
        // $excursion = $excursionRepo->findAll();
        // $vars = ['excursion' => $excursion];
        // dd($vars);
        // on crée le formulaire du type souhaité
        $formulaireDevis = $this->createForm (ReservationType::class,$unDevis, array('action' => $this->generateUrl("demande_devis"), 'method' => 'POST'));
        $formulaireDevis->handleRequest($request);
        $detailExcursion = new DetailExcursion();
        $detailExcursion->setReservation($unDevis);
        // je dois envoyer l'id d'excursion a l'entité detailExcursion
        // $detailExcursion->setExcursion($excursion);

        // dd($detailExcursion);
        // $detailExcursion->setExcursion($excursion);
        $formDetailExcursion = $this->createForm(DetailExcursionType::class,$detailExcursion);
        $formDetailExcursion->handleRequest($request);
        
        
        if ($formulaireDevis->isSubmitted() && $formulaireDevis->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unDevis);
            // $em->persist($excursion);
            
            $em->persist($detailExcursion);
            $em->flush();
            //return new Response('votre devis a été envoyé');
        }
            // on envoie un objet FormView à la vue pour qu'elle puisse 
            // faire le rendu, pas le formulaire en soi
            // $devis = ['devis'=>$formulaireDevis->createView()];
            // $detailExcursion1=['formDetail'=>$formDetailExcursion->createView()];
            
            
            return $this->render ('/accueil/devis.html.twig',
            [
                'devis'=>$formulaireDevis->createView(),
                // 'excursion' => $excursion,            
                'formDetail'=>$formDetailExcursion->createView(),
                'userConnecte'=>$this->getUser()]);
            // ['devis'=>$devis,'excursion'=>$vars,'detail'=>$formDetailExcursion,'userActif'=>$this->getUser()]);
            // $vars = ['devis' => $formulaireDevis->createView()];
            
            // return $this->render ('/accueil/index.html.twig', $vars);     
        }  
      
}
