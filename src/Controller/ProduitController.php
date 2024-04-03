<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TypeProduitRepository;
use App\Repository\SupporterRepository;
use App\Repository\SupportRepository;
use App\Repository\PhotoRepository;
use App\Repository\ProduitRepository;
use App\Form\AddProduitType;
use App\Form\SupporterType;
use App\Form\AddSupportType;
use App\Entity\Support;
use App\Entity\Supporter;
use App\Entity\Produit;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class ProduitController extends AbstractController
{
    #[Route('/Produit/{id}', name: 'app_Produit')]
    public function Produit(int $id, ProduitRepository $ProduitRepository): Response
    {
        $produit = $ProduitRepository->find($id);
        return $this->render('produit/Produit.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/private-listeProduit', name: 'app_listeProduit')]
    public function listeProduit(ProduitRepository $ProduitRepository): Response
    {
        $Produits = $ProduitRepository->findAll();
        return $this->render('produit/liste-Produit.html.twig', [
            'Produits' => $Produits
        ]);
    }
    
    #[Route('/private-listeSupport', name: 'app_listeSupport')]
    public function listeSupport(SupportRepository $SupportRepository): Response
    {
        $Supports = $SupportRepository->findAll();
        return $this->render('produit/liste-Support.html.twig', [
            'Supports' => $Supports
        ]);
    }

    #[Route('/private-listeSupporter', name: 'app_listeSupporter')]
    public function listeSupporter(SupporterRepository $SupporterRepository): Response
    {
        $Supporters = $SupporterRepository->findAll();
        return $this->render('produit/liste-Supporter.html.twig', [
            'Supporters' => $Supporters
        ]);
    }

    #[Route('/private-addProduit', name: 'app_addProduit')]
    public function addProduit(Request $request, EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $form = $this->createForm(AddProduitType::class, $produit);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($produit);
                $em->flush();
                $this->addFlash('notice','Produit Ajouter');
                return $this->redirectToRoute('app_listeProduit');
            }
        }
        return $this->render('produit/AddProduit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/private-addSupporter', name: 'app_addSupporter')]
    public function addSupporter(Request $request, EntityManagerInterface $em): Response
    {
        $Supporter = new Supporter();
        $form = $this->createForm(SupporterType::class, $Supporter);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($Supporter);
                $em->flush();
                $this->addFlash('notice','Compatibilité Ajouter');
                return $this->redirectToRoute('app_listeSupporter');
            }
        }
        return $this->render('produit/AddSupporter.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/private-addSupport', name: 'app_AddSupport')]
    public function addSupport(Request $request, EntityManagerInterface $em): Response
    {
        $Support = new Support();
        $form = $this->createForm(AddSupportType::class, $Support);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($Support);
                $em->flush();
                $this->addFlash('notice','Support Ajouter');
                return $this->redirectToRoute('app_listeSupport');
            }
        }
        return $this->render('produit/AddSupport.html.twig', [
            'form' => $form->createView()
        ]);
    }



}
