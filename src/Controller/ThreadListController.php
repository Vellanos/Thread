<?php

namespace App\Controller;

use App\Entity\Thread;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            'controller_name' => 'ThreadListController',
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
            'controller_name' => 'ThreadListController',
            'thread' => $thread,
            'responses' => $responses,
        ]);
    }
}
