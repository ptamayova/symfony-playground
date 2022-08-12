<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class PlaygorundController extends AbstractController
{
    #[Route('/playground', name: 'app_playground', methods: ['GET'])]
    public function playground(): Response
    {
        return $this->render('playground/playground.html.twig', [
            'title' => 'This is the Playground',
            'time' => $this->getDateTimeString()
        ]);
    }

    #[Route('/browse', name: 'app_playground_browse')]
    public function playgroundBrowse(): Response
    {
        return $this->render('playground/browse.html.twig', [
            'title' => 'Browse!'
        ]);
    }

    #[Route('/api/get-time', name: 'api_get_time', methods: ['GET'],)]
    public function getTime(): Response
    {
        return $this->json([
            'time' => $this->getDateTimeString()
        ]);
    }

    private function getDateTimeString() {
        $datetime = new DateTime();
        $datetime->setTimezone(new DateTimeZone('Europe/Berlin'));

        return $datetime
            ->format('H:i:s \o\n d/m/Y');
    }
}