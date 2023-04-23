<?php

namespace App\CampRegistrationSystem\Client;

use App\CampRegistrationSystem\Impl\ClientInterface;
use App\CampRegistrationSystem\RegistrationData;
use Munus\Collection\Stream;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MS365Client implements ClientInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private string $campsListsEndpoint,
        private string $registrationEndpoint,
        private string $errorReportingEndpoint
    ) {

    }

    public function getCamps(): Stream
    {
        $factory = new CampFactory();
        $response = $this->client->request('GET', $this->campsListsEndpoint);
        return Stream::ofAll($response->toArray())
                    ->map(fn ($record) =>$factory->create($record));
    }

    public function register(RegistrationData $data): void
    {
        $this->client->request('POST', $this->registrationEndpoint, [
            'json'=>$data
        ]);
    }

    public function reportError($data):void{
        $this->client->request('POST', $this->errorReportingEndpoint, [
            'json'=>$data
        ]);
    }
}
