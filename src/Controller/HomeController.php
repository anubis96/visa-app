<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/statut', name: 'app_statut')]
    public function statut(): Response
    {
        $user = $this->getUser();

        return $this->render('home/statut.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/aide', name: 'app_aide')]
    public function aide(): Response
    {
        return $this->render('home/aide.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }

    #[Route('/a-propos', name: 'app_a_propos')]
    public function aPropos(): Response
    {
        return $this->render('home/a_propos.html.twig');
    }
}
