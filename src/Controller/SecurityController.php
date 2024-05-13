<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\RoleType;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    #[Route('/Profil', name: 'app_profil')]
    public function Profil(UserRepository $UserRepository): Response
    { 
        return $this->render('base/compte.html.twig', [
            
        ]);
    }
    #[Route('/liste_user', name: 'app_user')]
    public function liste_user(UserRepository $UserRepository): Response
    { 
        $Users = $UserRepository->findAll();
        return $this->render('base/liste-user.html.twig', [
            'Users' => $Users
        ]);
    }
    
    #[Route('/private-modifier-role/{id}', name: 'app_modifierRoles')]
    public function modifierRole(Request $request, User $user,EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RoleType::class, $user);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
            $em->persist($user);
            $em->flush();
            $this->addFlash('notice','Role modifiée');
            return $this->redirectToRoute('app_user');
            }
        }
        return $this->render('base/modifier-Roles.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}
