<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SupporterController extends AbstractController
{
    #[Route('/supporter', name: 'app_supporter')]
    public function index(): Response
    {
        return $this->render('supporter/index.html.twig', [
            'controller_name' => 'SupporterController',
        ]);
    }
}
