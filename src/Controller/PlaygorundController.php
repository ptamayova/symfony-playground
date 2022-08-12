<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaygorundController extends AbstractController
{
    #[Route('/playground', name: 'playground')]
    public function playground(): Response
    {
        $datetime = new DateTime();
        $time = '@ ' . $datetime->format('H:i:s \O\n Y-m-d');

        return $this->render('playground/playground.html.twig', [
            'title' => 'This is the Playground',
            'time' => $time
        ]);
    }
}