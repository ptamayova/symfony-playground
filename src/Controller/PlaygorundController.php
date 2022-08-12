<?php

namespace App\Controller;

use DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaygorundController extends AbstractController
{
    #[Route('/playground', name: 'app_playground', methods: ['GET'])]
    public function playground(LoggerInterface $logger): Response
    {
        $datetime = new DateTime();
        $time = '@ ' . $datetime->format('H:i:s \O\n Y-m-d');

        $logger->info('This a log INFO message');

        return $this->render('playground/playground.html.twig', [
            'title' => 'This is the Playground',
            'time' => $time
        ]);
    }

    #[Route('/browse', name: 'app_playground_browse')]
    public function playgroundBrowse(): Response
    {
        return $this->render('playground/browse.html.twig', [
            'title' => 'Browse!'
        ]);
    }
}