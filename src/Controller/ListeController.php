<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
class ListeController extends AbstractController
{
    #[Route('/private-adorer/{id}', name: 'app_adorer')]
    public function adorer(Produit $Produit,EntityManagerInterface $em, ): Response
    {
        if ($this->getUser()->getAimer()->contains($Produit)) {
            $this->getUser()->removeAimer($Produit);
        } else {
            $this->getUser()->addAimer($Produit);
        }
        $em->persist($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_base');
    }

    #[Route('/Private-Liste_favoris', name:'app_liste_favoris')]
    public function favoris() : Response
    {
        $favoris=$this->getUser()->getAimer();
        return $this->render('liste/liste-favoris.html.twig', [
            'Favoris'=> $favoris,
        ]);
        
    }

    #[Route('/private-adorer-liste/', name: 'app_adorer_liste')]
    public function adorerListe(Produit $Produit,EntityManagerInterface $em, ): Response
    {
        if ($this->getUser()->getAimer()->contains($Produit)) {
            $this->getUser()->removeAimer($Produit);
        } else {
            $this->getUser()->addAimer($Produit);
        }
        $em->persist($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_Produit');
    }
}