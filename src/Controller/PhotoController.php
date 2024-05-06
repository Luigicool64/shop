<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\PhotoType;
use App\Entity\Photo;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PhotoController extends AbstractController
{
    #[Route('/photo', name: 'app_photo')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $photo = new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($photo);
                $em->flush();
                $this->addFlash('notice', 'Photo Ajouter');
                return $this->redirectToRoute('app_base');
            }
        }
        return $this->render('photo/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
