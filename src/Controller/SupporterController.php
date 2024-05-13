<?php

namespace App\Controller;

use App\Form\SupporterType;
use App\Form\ModifierSupporterType;
use App\Entity\Supporter;
use App\Repository\SupporterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/private-modifier-Supporter/{id}', name: 'app_modifierSupporter')]
    public function modifierSupporter(Request $request,Supporter $Supporter,EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ModifierSupporterType::class, $Supporter);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
            $em->persist($Supporter);
            $em->flush();
            $this->addFlash('notice','Supporter modifiée');
            return $this->redirectToRoute('app_listeSupporter');
            }
        }
        return $this->render('produit/modifier-Produit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/private-supprimer-Supporter/{id}', name: 'app_supprimerSupporter')]
    public function supprimerSupporter(Request $request,Supporter $Supporter,EntityManagerInterface $em): Response
    {
    if($Supporter!=null){
        $em->remove($Supporter);
        $em->flush();
        $this->addFlash('notice','Supporter supprimée');
    }
    return $this->redirectToRoute('app_listeSupporter');
    }
}
