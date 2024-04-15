<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ThreadListController extends AbstractController
{
    #[Route('/thread/list', name: 'app_thread_list')]
    public function index(): Response
    {
        return $this->render('thread_list/index.html.twig', [
            'controller_name' => 'ThreadListController',
        ]);
    }
}
