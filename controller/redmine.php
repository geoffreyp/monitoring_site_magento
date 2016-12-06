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

function getNbTicketClosedToday($apikey){
    $tomorrow =  time() + 86400;
    $current = date('Y-m-d');
    $tomorrow = date('Y-m-d',$tomorrow);
    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);
    $response = $client->request('GET', 'http://www.hostedredmine.com/issues.json?project_id=43188&status_id=closed&updated_on=%3E%3C'.$current.'|'.$tomorrow.'',
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json = json_decode($response->getBody());

    return $json->{'total_count'};
}
getNbTicketClosedToday("c232cdf169899c7c6074eecf42f7827ae37be34e");