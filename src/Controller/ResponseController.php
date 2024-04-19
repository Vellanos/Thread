<?php

namespace App\Controller;

use App\Entity\Response as EntityResponse;
use App\Entity\Thread;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ResponseFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResponseController extends AbstractController
{
    #[Route('/thread/{id_thread}/response/new', name: 'app_response_new', priority: 10)]
    public function createThread(
        $id_thread,
        Request $request,
        EntityManagerInterface $entityManager,
    ) {
        $response = new EntityResponse();

        $threadRepository = $entityManager->getRepository(Thread::class);
        $thread = $threadRepository->find($id_thread);

        $form = $this->createForm(ResponseFormType::class, $response);

        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid() && !empty($user)) {
            $response->setCreated(new \Datetime);
            $response->setEdited(new \Datetime);
            $response->setUser($user);
            $response->setThread($thread);

            $entityManager->persist($response);
            $entityManager->flush();
            return $this->redirectToRoute('app_thread', ['id' => $id_thread]);
        }

        return $this->render('response/create.html.twig', [
            'createForm' => $form
        ]);
    }

    #[Route('/thread/{id_thread}/response/{id_response}/edit', name: 'app_response_edit')]
    public function editResponse(
        $id_thread,
        $id_response,
        EntityManagerInterface $entityManager,
        Request $request
    ) {
        $responseRepository = $entityManager->getRepository(EntityResponse::class);
        $response = $responseRepository->find($id_response);

        $threadRepository = $entityManager->getRepository(Thread::class);
        $thread = $threadRepository->find($id_thread);

        $form = $this->createForm(ResponseFormType::class, $response);

        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid() && !empty($user)) {
            $response->setEdited(new \Datetime);
            $response->setUser($user);
            $response->setThread($thread);

            $entityManager->persist($response);
            $entityManager->flush();
            return $this->redirectToRoute('app_thread', ['id' => $id_thread]);
        }

        return $this->render('response/edit.html.twig', [
            'editForm' => $form,
            'response' => $response
        ]);
    }

    #[Route('/thread/{id_thread}/response/{id_response}/delete', name: 'app_response_delete')]
    public function deleteResponse($id_thread, $id_response, EntityManagerInterface $entityManager): Response
    {
        $responseRepository = $entityManager->getRepository(EntityResponse::class);
        $response = $responseRepository->find($id_response);

        $threadRepository = $entityManager->getRepository(Thread::class);
        $thread = $threadRepository->find($id_thread);

        if (!$response) {
            throw $this->createNotFoundException('Response not found');
        }

        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if ($response->getUser() !== $user) {
            throw $this->createAccessDeniedException('You are not allowed to delete this thread');
        }

        $entityManager->remove($response);
        $entityManager->flush();

        return $this->redirectToRoute('app_thread', ['id' => $id_thread]);
    }
}
