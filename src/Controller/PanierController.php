<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Panier;
use App\Entity\Ajouter;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;

class PanierController extends AbstractController
{
    #[Route('/private-supppanier', name: 'app_panier')]
    public function supppanier(EntityManagerInterface $em,Produit $Produit): Response
    {
        foreach ($this->getUser()->getPanier()->getAjouter() as $ajouter){
            if ($this->getUser()->getPanier()->getAjouter()->contains($ajouter)){
                if ($this->getProduit() == $Produit)
                    $this->getUser()->getPanier()->removeAjouter($ajouter);
            }
        }
        $em->persist($this->getUser());
        $em->flush();
        $this->addFlash('notice',$jeu->getNom().'supprimé du panier');
        return $this->redirectToRoute('app_base');
    }

    #[Route('/private-ajoutpanier/{id}', name: 'app_ajoutpanier')]
    public function ajoutpanier(Produit $Produit, EntityManagerInterface $em): Response
    {
        if ($Produit!=null){
            if($this->getUser()->getPanier() == null){
                $panier= new Panier();
                $this->getUser()->setPanier($panier);
            } else {
                $panier=$this->getUser()->getPanier();
            }
            $ajouter=new Ajouter();
            $ajouter->setQuantite(1);
            $ajouter->setPanier($panier);
            $ajouter->setProduit($Produit);
            $panier->addAjouter($ajouter);
            $em->persist($panier);
            $em->persist($this->getUser());
            $em->persist($ajouter);
            $em->flush();
        }
        return $this->redirectToRoute('app_Produit',['id' =>$Produit->getId()]);
    }

    #[Route('/private-ajoutpaniersupport/{id}', name: 'app_ajoutpaniersupport')]
    public function ajoutpaniersupport(Produit $Produit, EntityManagerInterface $em): Response
    {
        if ($Produit!=null){
            if($this->getUser()->getPanier() == null){
                $panier= new Panier();
                $this->getUser()->setPanier($panier);
                
            } else {
                $panier=$this->getUser()->getPanier();
            }
            $ajouter=new Ajouter();
            $ajouter->setQuantite(1);
            $ajouter->setPanier($panier);
            $ajouter->setProduit($Produit);
            $panier->addAjouter($ajouter);
            $em->persist($panier);
            $em->persist($this->getUser());
            $em->persist($ajouter);
            $em->flush();
        }
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/private-ajoutpanierbase/{id}', name: 'app_ajoutpanierbase')]
    public function ajoutpanierbase(Produit $Produit, EntityManagerInterface $em): Response
    {
        if ($Produit!=null){
            if($this->getUser()->getPanier() == null){
                $panier= new Panier();
                $this->getUser()->setPanier($panier);
            } else {
                $panier=$this->getUser()->getPanier();
            }
            $ajouter=new Ajouter();
            $ajouter->setQuantite(1);
            $ajouter->setPanier($panier);
            $ajouter->setProduit($Produit);
            $panier->addAjouter($ajouter);
            $em->persist($panier);
            $em->persist($this->getUser());
            $em->persist($ajouter);
            $em->flush();
        }
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/private-panier', name: 'app_panier')]
    public function panier(Produit $Produit): Response
    {
        return $this->render('panier/panier.html.twig', [
            
        ]);
    }

}
