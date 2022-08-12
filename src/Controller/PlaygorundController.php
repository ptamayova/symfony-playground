<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;
use Knp\Bundle\TimeBundle\DateTimeFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function playgroundBrowse(DateTimeFormatter $timeFormatter): Response
    {
        return $this->render('playground/browse.html.twig', [
            'title' => 'Browse!',
            'mixes' => $this->getMixes()
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

    private function getMixes(): array
    {
        // temporary fake "mixes" data
        return [
            [
                'title' => 'PB & Jams',
                'trackCount' => 14,
                'genre' => 'Rock',
                'createdAt' => new \DateTime('2021-10-02'),
            ],
            [
                'title' => 'Put a Hex on your Ex',
                'trackCount' => 8,
                'genre' => 'Heavy Metal',
                'createdAt' => new \DateTime('2022-04-28'),
            ],
            [
                'title' => 'Spice Grills - Summer Tunes',
                'trackCount' => 10,
                'genre' => 'Pop',
                'createdAt' => new \DateTime('2019-06-20'),
            ],
        ];
    }

}