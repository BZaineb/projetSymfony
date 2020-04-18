<?php

namespace App\Controller;

use App\Entity\Visite;
use App\Form\VisiteType;
use App\Entity\Excursion;
use App\Form\ExcursionType;
use App\Repository\VisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulairesController extends AbstractController
{
    /**
     * @Route("/insert/visite", name="ajout_visite")
     */
    public function insertVisite(Request $request)
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
            return new Response("fichier inséré et bd mise à jour");
        }               
        else{
                $vars = ['formulaireVisite'=>$formulaireVisite->createView()];
                return $this->render('formulaires/add_visite.html.twig',$vars);               
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
        return $this->render('formulaires/edit_visite.html.twig', $vars);
    }

    /**
     * @Route("/edit/visites/{id}", name="modifier_visites")
     */
    public function editVisite(Request $request, Visite $visite)
    {
        $formulaireVisite = $this->createForm(VisiteType::class, $visite);
        // dd($visite);
        $formulaireVisite->handleRequest($request);
        if ($formulaireVisite->isSubmitted() && $formulaireVisite->isValid())
         {
            $fichier = $visite->getPhoto();
            $nomFichierServeur = md5(uniqid()).".".$fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $visite->setPhoto($nomFichierServeur);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return new Response("fichier modifié et bd mise à jour");
        }   
        else{
            $vars = ['formulaireVisite'=>$formulaireVisite->createView()];
            return $this->render('formulaires/modif_visite.html.twig',$vars);               
        } 
    }           
    // /**
    //  * @Route("/edit/visites/{id}", name="modifier_visites")
    //  */                          
    //     public function editVisite(Request $request, Visite $visite){
    //     $id = $request->request->get('id');
    //     dd($id);
    //     $em = $this->getDoctrine()->getManager();
    //     $visiteRepo = $em->getRepository(Visite::class);
    //     $visite= $visiteRepo->findOneBy(array('id'=>$id));
    //     dd($visite);
    //     $visite->get($req->request->setNom('nom'));
        
    //     $visite->setDescription($req->request->get('description'));
    //     $visite->setPhoto($req->request->get('photo'));
    //     $visite->setDureeRecommandee($req->request->get('dureeRecommandee'));
        
    //     $em->flush();
        
    //     return $this->render('formulaires/edit_visite.html.twig');
    // }
     /**
     * @Route("/delete/visites", name="effacer_visites")
     */
    public function deleteVisite(Request $request)
    {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $visite = $em->getRepository(Visite :: class)->findBy(array("id"=>$id));
        dd($visite);
        
        $em->remove($visite);
        $em->flush();
        
        return $this->render('formulaires/update_visite.html.twig');
    }

    /**
     * @Route("/insert/excursion", name="ajout_excursion")
     */
    public function insertExcursion(Request $request)
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
            return new Response("fichier enregistré et bd mise à jour");
        }
        else{
            $vars = ['formulaireExcursion'=>$formulaireExcursion->createView()];
            return $this->render('formulaires/add_excursion.html.twig',$vars);
        }
        
    }
}
