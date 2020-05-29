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
        return $this->render('accueil/edit_profil.html.twig', $vars);
    }
    /**
     * @Route("/modifier/profil/{id}", name="modifier_profil")
     */
    public function clientEdit(Request $request, User $user){
    
        $userId= $this->getUser()->getId();
        // dd($user->getId());
        // =$request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $profil = $em->getRepository(User::class)->find($userId);
        // dd($profil);
        $profil->setNom($request->request->get('nom'));
        $profil->setPrenom($request->request->get('prenom'));
        $profil->setPseudo($request->request->get('pseudo'));
        $profil->setEmail($request->request->get('email'));
        $profil->setPays($request->request->get('pays'));
        
        $em->flush();
        $vars = ['profil' => $profil];
        return $this->render('accueil/profil.html.twig',$vars);
        // return $this->redirectToRoute("accueil");

    }
    /**
     * @Route("/meteo", name="meteo")
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
        // on crée le formulaire du type souhaité
        $formulaireDevis = $this->createForm (ReservationType::class,$unDevis, array('action' => $this->generateUrl("demande_devis"), 'method' => 'POST'));
        $formulaireDevis->handleRequest($request);
        $detailExcursion = new DetailExcursion();
        
        // je dois envoyer l'id d'excursion a l'entité detailExcursion
        
        $formDetailExcursion = $this->createForm(DetailExcursionType::class,$detailExcursion);
        $formDetailExcursion->handleRequest($request);      
        if ($formulaireDevis->isSubmitted()) 
        // && $formulaireDevis->isValid()) 
        {
            $unDevis->setUser($this->getUser());
            $detailExcursion->setReservation($unDevis);
            $em = $this->getDoctrine()->getManager();
            $em->persist($unDevis);        
            $em->persist($detailExcursion);
            $em->flush();
        }
            return $this->render ('/accueil/devis.html.twig',
            [
                'devis'=>$formulaireDevis->createView(),           
                'formDetail'=>$formDetailExcursion->createView(),
                'userConnecte'=>$this->getUser()]);    
    }  
}
