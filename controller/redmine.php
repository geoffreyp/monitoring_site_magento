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

function getNbTicketClosedMonth($apikey){
    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);
    $response = $client->request('GET', 'http://www.hostedredmine.com/issues.json?project_id=43188&status_id=closed&updated_on=%3E%3D'.date('Y').'-'.date('m').'-01',
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json = json_decode($response->getBody());

    return $json->{'total_count'};
}

function getNbTicketByGroup($apikey, $group){

    $nb = 0;

    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);

    $response1 = $client->request('GET', 'http://www.hostedredmine.com/projects/ulco2016project1/memberships.json',
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json1 = json_decode($response1->getBody());

    $nbElements  = $json1->{'total_count'};;



    for ($i=0; $i<$nbElements; $i++) {

        $currentGroup = $json1->memberships[$i]->roles[0]->id;

        if ($currentGroup == $group){

            $currentUser = $json1->memberships[$i]->user->id;
            $response2 = $client->request('GET', 'http://www.hostedredmine.com/issues.json?project_id=43188&assigned_to_id='.$currentUser.'&status_id=opened',
                ['headers' => ['X-Redmine-API-Key' => $apikey]]);

            $json2 = json_decode($response2->getBody());

            $nb = $nb + intval($json2->{'total_count'});


        }
    }
    return $nb;
}

