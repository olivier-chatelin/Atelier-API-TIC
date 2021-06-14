<?php


namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NutApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetch(): array
    {
        $response = $this->client->request(
            'GET',
            'http://79ed5d2403b4.ngrok.io/nuts'

        );
        $content = $response->getContent();
        $content = $response->toArray();
        return $content;
    }
    public function send($id,$quantity)
    {
         $response = $this->client->request(
            'POST',
            'http://79ed5d2403b4.ngrok.io/nut/buy/' . $id,
             [
                 'body' => ['quantity' => $quantity]
             ]
        );
        $content = $response->getContent();
        $content = $response->toArray();
        return $content;


    }

}

