<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Form\ThreadFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as httpResponse;
use Symfony\Component\Routing\Annotation\Route;

class ThreadListController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/thread/list', name: 'app_thread_list')]
    public function index(): httpResponse
    {
        $threadRepository = $this->entityManager->getRepository(Thread::class);
        $threads = $threadRepository->findAll();

        return $this->render('thread/index.html.twig', [
            'threads' => $threads,
        ]);
    }

    #[Route('/thread/{id}', name: 'app_thread')]
    public function threadDetails($id): httpResponse
    {
        $threadRepository = $this->entityManager->getRepository(Thread::class);
        $thread = $threadRepository->findOneBy(['id' => $id]);
        $responses = $thread->getResponses();

        return $this->render('thread/details.html.twig', [
            'thread' => $thread,
            'responses' => $responses,
        ]);
    }

    #[Route('/thread/new', name: 'app_thread_new')]
    public function createCharacter(
        Request $request,
        EntityManagerInterface $entityManager
    ) {
        $thread = new Thread();

        $form = $this->createForm(ThreadFormType::class, $thread);

        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {

            $this->$entityManager->persist($thread);
            $this->$entityManager->flush();
        }

        return $this->render('thread/create.html.twig', [
            'createForm' => $form
        ]);
    }
}
