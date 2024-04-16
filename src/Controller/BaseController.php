<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use App\Repository\TypeProduitRepository;




class BaseController extends AbstractController
{
    #[Route('/', name: 'app_base')]
    public function index(TypeProduitRepository $TypeProduitRepository):Response
    {
        $TypeProduits = $TypeProduitRepository->findBy(array(),array('typeProduit'=>'ASC'));
        return $this->render('base/index.html.twig', [
            'TypeProduits'=> $TypeProduits
        ]);
    }
    
}
