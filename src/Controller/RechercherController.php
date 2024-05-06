<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RechercherController extends AbstractController
{
    #[Route('/rechercher', name: 'app_rechercher')]
    public function index(): Response
    {
        return $this->render('rechercher/index.html.twig', [
            'controller_name' => 'RechercherController',
        ]);
    }
}
