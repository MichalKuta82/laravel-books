<?php

namespace App\Traits;
use GuzzleHttp\Client as GuzzleClient;

trait ApiTrait
{
	public function getApi()
    {
        $client = new GuzzleClient();
        $response = $client->get('https://restcountries.eu/rest/v2/all');

        return json_decode($response->getBody());
    }
}