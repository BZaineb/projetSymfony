<?php

namespace App\Controller;

use App\Entity\Excursion;
use App\Entity\Visite;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $visiteRepo = $em->getRepository(Visite ::class);
        $visites = $visiteRepo->findAll();
        $vars = ['visite'=>$visites];
        return $this->render('front/index.html.twig',$vars);
    }
     /**
     * @Route("/visite", name="visite")
     */
    public function visite()
    {
        $em = $this->getDoctrine()->getManager();
        $visiteRepo = $em->getRepository(Visite ::class);
        $visites = $visiteRepo->findAll();
        $vars = ['visite'=>$visites];
        return $this->render('front/visite.html.twig', $vars);
        // return $this->render('front/visite.html.twig');
    }
     /**
     * @Route("/excursion", name="excursion")
     */
    public function excursion()
    {
        $em = $this->getDoctrine()->getManager();
        $excursionRepo = $em->getRepository(Excursion ::class);
        $excursions = $excursionRepo->findAll();
        $vars = ['excursion'=>$excursions];
        return $this->render('front/excursion.html.twig', $vars);
    }

     /**
     * @Route("/detail", name="detail")
     */
    public function detail()
    {
        return $this->render('front/detail.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('front/contact.html.twig');
    }

    
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('front/about.html.twig');
    }

}
