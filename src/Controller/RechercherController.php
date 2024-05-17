<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;

class RechercherController extends AbstractController
{
    #[Route('/rechercher', name: 'app_rechercher')]
    public function index(ProduitRepository $ProduitRepository,Request $request): Response
    {   
        $query = $request->query->get('q');
        $Produit = $ProduitRepository->findBySearchQuery($query);

        return $this->render('rechercher/index.html.twig', [
            'produit'=> $Produit,
            'q' => $query,
        ]);
    }
}
