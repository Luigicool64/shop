<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SupporterType;
use App\Entity\Supporter;
use App\Repository\SupporterRepository;
use Doctrine\ORM\EntityManagerInterface;


class SupporterController extends AbstractController
{
    #[Route('/private-addSupporter', name: 'app_addSupporter')]
    public function addSupporter(Request $request, EntityManagerInterface $em): Response
    {
        $Supporter = new Supporter();
        $form = $this->createForm(SupporterType::class, $Supporter);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($Supporter);
                $em->flush();
                $this->addFlash('notice', 'Compatibilité Ajouter');
                return $this->redirectToRoute('app_listeSupporter');
            }
        }
        return $this->render('supporter/AddSupporter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/private-listeSupporter', name: 'app_listeSupporter')]
    public function listeSupporter(SupporterRepository $SupporterRepository): Response
    {
        $Supporters = $SupporterRepository->findAll();
        return $this->render('supporter/liste-Supporter.html.twig', [
            'Supporters' => $Supporters,
        ]);
    }
}
