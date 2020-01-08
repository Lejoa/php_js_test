<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/app", name="index")
     * @Route("/app/{all}", name="index_all ", requirements={"all": ".+"})
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }
}
