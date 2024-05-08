<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use App\Repository\TypeProduitRepository;
use App\Repository\SupportRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RechercherType;




class BaseController extends AbstractController
{
    #[Route('/', name: 'app_base')]
    public function index(TypeProduitRepository $TypeProduitRepository, SupportRepository $SupportRepository, Request $request):Response
    {
        $TypeProduits = $TypeProduitRepository->findBy(array(),array('typeProduit'=>'ASC'));
        $Supports = $SupportRepository->findBy(array(),array('nom'=>'ASC'));
        return $this->render('base/index.html.twig', [
            'TypeProduits' => $TypeProduits,
            'Supports' => $Supports
        ]);
    }
    
    #[Route('/Support-{id}', name: 'app_Support')]
    public function Produit(string $id, SupportRepository $SupportRepository): Response
    {
    $Support = $SupportRepository->find($id); 
    return $this->render('base/menu-Support.html.twig', [
        'Support' =>  $Support,  
    ]);
    }
    
   
}
