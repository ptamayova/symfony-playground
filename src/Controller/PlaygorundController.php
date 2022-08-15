<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/browse', name: 'app_playground_browse')]
    public function playgroundBrowse(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');

        return $this->render('playground/browse.html.twig', [
            'title' => 'Browse!',
            'mixes' => $response->toArray()
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