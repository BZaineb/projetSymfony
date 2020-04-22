<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Visite;
use App\Form\VisiteType;
use App\Entity\Excursion;
use App\Form\ExcursionType;
use App\Repository\VisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    //------Debut Action Visite-------//
    /**
     * @Route("/ajout/visite", name="ajout_visite")
     */
    public function ajoutVisite(Request $request)
    {
        $uneVisite = new Visite();
        $formulaireVisite = $this->createForm(VisiteType::class, $uneVisite, array('action' => $this->generateUrl("ajout_visite"), 'method' => 'POST'));
        $formulaireVisite->handleRequest($request);
        if ($formulaireVisite->isSubmitted() && $formulaireVisite->isValid()) {
            $fichier = $uneVisite->getPhoto();
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $uneVisite->setPhoto($nomFichierServeur);
            $em = $this->getDoctrine()->getManager();
            $em->persist($uneVisite);
            $em->flush();
            return $this->redirectToRoute('afficher_visite');
        } else {
            $vars = ['formulaireVisite' => $formulaireVisite->createView()];
            return $this->render('admin/add_visite.html.twig', $vars);
        }
    }
    /**
     * @Route("/admin", name="afficher_visite")
     */
    public function afficherVisite()
    {
        $em = $this->getDoctrine()->getManager();
        $visiteRepo = $em->getRepository(Visite::class);
        $visites = $visiteRepo->findAll();
        $vars = ['visite' => $visites];
        return $this->render('admin/list_visite.html.twig', $vars);
    }

    /**
     * @Route("/modifier/visites/{id}", name="modifier_visite")
     */
    public function modifierVisite(Request $request, Visite $visite)
    {
        // dd($request->get('id'));

        $formulaireVisite = $this->createForm(VisiteType::class, $visite);
        // dd($visite);
        $formulaireVisite->handleRequest($request);
        if ($formulaireVisite->isSubmitted() && $formulaireVisite->isValid()) {
            $fichier = $visite->getPhoto();
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $visite->setPhoto($nomFichierServeur);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('afficher_visite');
        } else {
            // dd($request->get('id'));
            $vars = [
                'formulaireVisite' => $formulaireVisite->createView(),
                'id' => $request->get('id')
            ];
            return $this->render('admin/modif_visite.html.twig', $vars);
        }
    }
    /**
     * @Route("/supprimer/visite/{id}", name="supprimer_visite")
     */
    public function supprimerVisite($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Visite::class);
        $visiteASupprime=$rep->find($id);
        $em->remove($visiteASupprime);
        $em->flush();

        return $this->redirectToRoute('afficher_visite');
    }
    //------Fin Action Visite-------//
    //------Debut Action Excursion-------//
    
    /**
     * @Route("/ajout/excursion", name="ajout_excursion")
     */
    public function ajoutExcursion(Request $request)
    {
        $uneExcursion = new Excursion();
        $formulaireExcursion = $this->createForm(ExcursionType::class, $uneExcursion, array('action' => $this->generateUrl("ajout_excursion"), 'method' => 'POST'));
        $formulaireExcursion->handleRequest($request);
        if ($formulaireExcursion->isSubmitted() && $formulaireExcursion->isValid()) {
            $fichier = $uneExcursion->getPhoto();
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $uneExcursion->setPhoto($nomFichierServeur);
            $em = $this->getDoctrine()->getManager();
            $em->persist($uneExcursion);
            $em->flush();
            return $this->redirectToRoute('afficher_excursion');
        } else {
            $vars = ['formulaireExcursion' => $formulaireExcursion->createView()];
            return $this->render('admin/add_excursion.html.twig', $vars);
        }
    }
    /**
     * @Route("/afficher/excursion", name="afficher_excursion")
     */
    public function afficherExcursion()
    {
        $em = $this->getDoctrine()->getManager();
        $excursionRepo = $em->getRepository(Excursion::class);
        $excursion = $excursionRepo->findAll();
        $vars = ['excursion' => $excursion];
        return $this->render('admin/list_excursion.html.twig', $vars);
    }
    /**
     * @Route("/modifier/excursion/{id}", name="modifier_excursion")
     */
    public function modifierExcursion(Request $request, Excursion $excursion)
    {
        $formulaireExcursion = $this->createForm(ExcursionType::class, $excursion);
        // dd($excursion);
        $formulaireExcursion->handleRequest($request);
        if ($formulaireExcursion->isSubmitted() && $formulaireExcursion->isValid()) {
            $fichier = $excursion->getPhoto();
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $excursion->setPhoto($nomFichierServeur);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('afficher_excursion');
        } else {
            // dd($request->get('id'));
            $vars = [
                'formulaireExcursion' => $formulaireExcursion->createView(),
                'id' => $request->get('id')
            ];
            return $this->render('admin/modif_excursion.html.twig', $vars);
        }
    }
     /**
     * @Route("/supprimer/excursion/{id}", name="supprimer_excursion")
     */
    public function supprimerExcursion($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Excursion::class);
        $excursionASupprime=$rep->find($id);
        $em->remove($excursionASupprime);
        $em->flush();

        return $this->redirectToRoute('afficher_excursion');
    }
    //------Fin Action Excursion-------//
    //------Debut Action User-------//
    /**
     * @Route("/afficher/user", name="afficher_user")
     */
    public function listUser()
    {
        $em = $this->getDoctrine()->getManager();
        $userRepo = $em->getRepository(User::class);
        $user = $userRepo->findAll();
        $vars = ['user' => $user];
        return $this->render('admin/list_user.html.twig', $vars);
    }
    //------Fin Action User-------//
}
