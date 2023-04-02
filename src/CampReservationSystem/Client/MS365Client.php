<?php

namespace App\CampReservationSystem\Client;

use App\CampReservationSystem\Camp;
use App\CampReservationSystem\CampId;
use App\CampReservationSystem\Impl\ClientInterface;
use Munus\Collection\Stream;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MS365Client implements ClientInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private string $campsListsEndpoint
    ) {
        
    }

    public function getCamps():Stream
    {
        $response = $this->client->request('GET', $this->campsListsEndpoint);
        return Stream::ofAll($response->toArray())
                    ->map(fn($record)=>new Camp(new CampId(sha1($record['id'])), $record['name']));
    }
}
