<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\AddProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    #[Route('produit/{id}', name: 'app_Produit')]
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
            'Produits' => $Produits,
        ]);
    }

    #[Route('/private-addProduit', name: 'app_addProduit')]
    public function addProduit(Request $request, EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $form = $this->createForm(AddProduitType::class, $produit);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($produit);
                $em->flush();
                $this->addFlash('notice', 'Produit Ajouter');
                return $this->redirectToRoute('app_listeProduit');
            }
        }
        return $this->render('produit/AddProduit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
