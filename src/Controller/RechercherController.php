<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProduitRepository;
use App\Form\RechercherType;
use App\Data\SearchData;
use Symfony\Component\HttpFoundation\Request;

class RechercherController extends AbstractController
{
    #[Route('/rechercher', name: 'app_rechercher')]
    public function index(ProduitRepository $ProduitRepository,): Response
    {   
        
        $produit = $ProduitRepository->findSearch();
        return $this->render('rechercher/index.html.twig', [
            'produit'=> $produit,
        ]);
    }
}
