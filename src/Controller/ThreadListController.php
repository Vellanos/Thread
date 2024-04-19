<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Entity\ThreadVote;
use App\Form\ThreadFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as httpResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ThreadListController extends AbstractController
{

    #[Route('/thread', name: 'app_thread_list')]
    public function index(EntityManagerInterface $entityManager): httpResponse
    {
        $threadRepository = $entityManager->getRepository(Thread::class);
        $threads = $threadRepository->findAll();

        return $this->render('thread/index.html.twig', [
            'threads' => $threads,
        ]);
    }

    #[Route('/thread/{id}', name: 'app_thread')]
    public function threadDetails($id, EntityManagerInterface $entityManager): httpResponse
    {
        $threadRepository = $entityManager->getRepository(Thread::class);
        $thread = $threadRepository->findOneBy(['id' => $id]);
        $responses = $thread->getResponses();

        return $this->render('thread/details.html.twig', [
            'thread' => $thread,
            'responses' => $responses,
        ]);
    }

    #[Route('/thread/new', name: 'app_thread_new', priority: 10)]
    public function createThread(
        Request $request,
        EntityManagerInterface $entityManager,
    ) {
        $thread = new Thread();

        $form = $this->createForm(ThreadFormType::class, $thread);

        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid() && !empty($user)) {

            $thread->setCreated(new \Datetime());
            $thread->setEdited(new \Datetime());
            $thread->setStatus("open");
            $thread->setIdUser($user);

            $entityManager->persist($thread);
            $entityManager->flush();
            return $this->redirectToRoute('app_thread', ['id' => $thread->getId()]);
        }

        return $this->render('thread/create.html.twig', [
            'createForm' => $form
        ]);
    }

    #[Route('/thread/{id}/edit', name: 'app_thread_edit')]
    public function editThread(
        $id,
        EntityManagerInterface $entityManager,
        Request $request
    ) {
        $threadRepository = $entityManager->getRepository(Thread::class);
        $thread = $threadRepository->find($id);

        $form = $this->createForm(ThreadFormType::class, $thread);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $thread->setEdited(new \Datetime);

            $entityManager->persist($thread);
            $entityManager->flush();
            return $this->redirectToRoute('app_thread', ['id' => $thread->getId()]);
        }

        return $this->render('thread/edit.html.twig', [
            'editForm' => $form,
            'thread' => $thread
        ]);
    }

    #[Route('/thread/{id}/voteUp', name: 'app_thread_vote_up')]
    public function voteUp(Thread $thread, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $existingVote = $entityManager->getRepository(ThreadVote::class)->findOneBy([
            'thread' => $thread,
            'user' => $user
        ]);

        if ($existingVote) {
            if (!$existingVote->isVote()) {
                $existingVote->setVote(true);
                $entityManager->flush();
            } else {
                $entityManager->remove($existingVote);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_thread', ['id' => $thread->getId()]);
        }

        $threadVote = new ThreadVote();
        $threadVote->setThread($thread);
        $threadVote->setUser($user);
        $threadVote->setVote(true);

        $entityManager->persist($threadVote);
        $entityManager->flush();

        return $this->redirectToRoute('app_thread', ['id' => $thread->getId()]);
    }

    #[Route('/thread/{id}/voteDown', name: 'app_thread_vote_down')]
    public function voteDown(Thread $thread, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $existingVote = $entityManager->getRepository(ThreadVote::class)->findOneBy([
            'thread' => $thread,
            'user' => $user
        ]);

        if ($existingVote) {
            if ($existingVote->isVote()) {
                $existingVote->setVote(false);
                $entityManager->flush();
            } else {
                $entityManager->remove($existingVote);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_thread', ['id' => $thread->getId()]);
        }

        $threadVote = new ThreadVote();
        $threadVote->setThread($thread);
        $threadVote->setUser($user);
        $threadVote->setVote(false);

        $entityManager->persist($threadVote);
        $entityManager->flush();

        return $this->redirectToRoute('app_thread', ['id' => $thread->getId()]);
    }

    #[Route('/thread/{id}/delete', name: 'app_thread_delete')]
    public function deleteThread($id, EntityManagerInterface $entityManager): Response
    {
        $threadRepository = $entityManager->getRepository(Thread::class);
        $thread = $threadRepository->find($id);

        if (!$thread) {
            throw $this->createNotFoundException('Thread not found');
        }

        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if ($thread->getIdUser() !== $user) {
            throw $this->createAccessDeniedException('You are not allowed to delete this thread');
        }

        $entityManager->remove($thread);
        $entityManager->flush();

        return $this->redirectToRoute('app_thread_list');
    }
}
