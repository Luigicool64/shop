<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;


class ListeController extends AbstractController
{
    #[Route('/private-adorer/{id}', name: 'app_adorer')]
    public function adorer(Produit $Produit,EntityManagerInterface $em): Response
    {
        if ($this->getUser()->addAimer()-contains($Produit)) {
            $this->getUser()->removeAimer($Produit);
        }
        else {
            $this->getUser()->addAimer($Produit);
        }
        $em->persist($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_base');
    }
    


}