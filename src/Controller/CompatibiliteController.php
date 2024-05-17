<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Supporter;
use App\Form\SupporterType;
use App\Repository\SupporterRepository;
use Symfony\Component\HttpFoundation\Request;



class CompatibiliteController extends AbstractController
{

    #[Route('/private-listesupporter', name:'app_liste_supporter' )]
    public function addSupporter(SupporterRepository $SupporterRepository): Response
    {
        $form = $this->createForm(SupporterType::class);
        return $this->render('compatibilité/addSupporter.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/private-app_addsupporter', name: 'app_addSupporter')]
    public function listeSupporter(Request $request, EntityManagerInterface $em): Response
    {
        
        return $this->render('produit/liste.html.twig', [
           
        ]);
    }
}
