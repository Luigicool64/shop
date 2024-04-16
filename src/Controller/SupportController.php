<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AddSupportType;
use App\Entity\Support;
use App\Repository\SupportRepository;
use Doctrine\ORM\EntityManagerInterface;

class SupportController extends AbstractController
{
    #[Route('/private-addSupport', name: 'app_AddSupport')]
    public function addSupport(Request $request, EntityManagerInterface $em): Response
    {
        $Support = new Support();
        $form = $this->createForm(AddSupportType::class, $Support);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($Support);
                $em->flush();
                $this->addFlash('notice', 'Support Ajouter');
                return $this->redirectToRoute('app_listeSupport');
            }
        }
        return $this->render('support/AddSupport.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/private-listeSupport', name: 'app_listeSupport')]
    public function listeSupport(SupportRepository $SupportRepository): Response
    {
        $Supports = $SupportRepository->findAll();
        return $this->render('support/liste-Support.html.twig', [
            'Supports' => $Supports,
        ]);
    }
}
