<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;


class AimeController extends AbstractController
{
    #[Route('/private-favoris', name: 'app_favoris')]
    public function index():Response
    {
        
        return $this->render('aimer/index.html.twig', [
            
        ]);
    }

    #[Route('/private-desadorer/{id}', name: 'app_desadorer')]
    public function desadorer(Produit $Produit,EntityManagerInterface $em): Response
    {
        
        $this->getUser()->removeAimer($Produit);
        $this->addFlash('favoris', 'Produit supprimer de vos favoris');
        $em->persist($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_favoris');
    }

    #[Route('/private-adorer-base/{id}', name: 'app_adorer_base')]
    public function adorerBase(Produit $Produit,EntityManagerInterface $em): Response
    {
        if ($this->getUser()->getAimer()->contains($Produit)) {
            $this->getUser()->removeAimer($Produit);
            $this->addFlash('favoris', 'Produit supprimer de vos favoris');
        }
        else {
            $this->getUser()->addAimer($Produit);
            $this->addFlash('favoris', 'Produit ajouter de vos favoris');
        }
        $em->persist($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_favoris');
    }

    #[Route('/private-adorer-support/{id}', name: 'app_adorer_support')]
    public function adorerSupport(Produit $Produit,EntityManagerInterface $em): Response
    {
        if ($this->getUser()->getAimer()->contains($Produit)) {
            $this->getUser()->removeAimer($Produit);
            $this->addFlash('favoris', 'Produit supprimer de vos favoris');
        }
        else {
            $this->getUser()->addAimer($Produit);
            $this->addFlash('favoris', 'Produit ajouter de vos favoris');
        }
        $em->persist($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_favoris');
    }

    #[Route('/private-adorer-detail/{id}', name: 'app_adorer_detail')]
    public function adorerdetait(Produit $Produit,EntityManagerInterface $em): Response
    {
        if ($this->getUser()->getAimer()->contains($Produit)) {
            $this->getUser()->removeAimer($Produit);
            $this->addFlash('favoris', 'Produit supprimer de vos favoris');
        }
        else {
            $this->getUser()->addAimer($Produit);
            $this->addFlash('favoris', 'Produit ajouter de vos favoris');
        }
        $em->persist($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_favoris');
    }

}