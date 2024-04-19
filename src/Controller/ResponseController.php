<?php

namespace App\Controller;

use App\Entity\Response as EntityResponse;
use App\Entity\Thread;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ResponseFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ResponseController extends AbstractController
{
    #[Route('/thread/{id_thread}/response/{id_response}/edit', name: 'app_response_edit')]
    public function editCharacter(
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
}
