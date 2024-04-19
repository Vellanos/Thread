<?php

namespace App\Controller;

use App\Entity\Response as EntityResponse;
use App\Entity\Thread;
use App\Entity\User;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function index($id, EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($id);

        $threadRepository = $entityManager->getRepository(Thread::class);
        $threads = $threadRepository->findBy(['user' => $id]);

        $responseRepository = $entityManager->getRepository(EntityResponse::class);
        $responses = $responseRepository->findBy(['user' => $id]);

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'user' => $user,
            'threads' => $threads,
            'responses' => $responses
        ]);
    }

    #[Route('/profile/{id}/edit', name: 'app_profile_edit')]
    public function userEdit($id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($id);

        $form = $this->createForm(ProfileFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEdited(new \Datetime);

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_profile', ['id' => $user->getId()]);
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'editForm' => $form
        ]);
    }

    #[Route('/delete/profile', name: 'app_profile_delete')]
    public function deleteUser(EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $this->getUser();

        if ($user) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        $security->logout(false);

        return $this->redirectToRoute('app_register');
    }
}
