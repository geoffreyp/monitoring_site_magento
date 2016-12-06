<?php
require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;


function getNbTicket($apikey){

    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);
    $response = $client->request('GET', 'http://www.hostedredmine.com/issues.json?project_id=43188&status_id=opened',
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json = json_decode($response->getBody());

    //echo ($json->{'total_count'});
    return $json->{'total_count'};
}
