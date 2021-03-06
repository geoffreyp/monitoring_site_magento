<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helper/Bdd.php';

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

    $nbElements  = $json1->{'total_count'};



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

function getNbTicketByStatus($apikey, $status_id){

    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);
    $response = $client->request('GET', 'http://www.hostedredmine.com/issues.json?project_id=43188&status_id='.$status_id,
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json = json_decode($response->getBody());

    return $json->{'total_count'};
}

function getTicket($apikey, $conf){

    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);
    $response = $client->request('GET', 'http://www.hostedredmine.com/issues.json?project_id=43188&status_id=*',
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json = json_decode($response->getBody());

    $nbElements  = $json->{'total_count'};

    $bdd = new Bdd($conf);
    $res_drop = $bdd->beginTransaction();

    for ($i=0; $i<$nbElements; $i++) {

        $idTicket = $json->issues[$i]->id;

        $verif = 0;

        if ($verif == 0) {


            $subject = $json->issues[$i]->subject;
            $description = $json->issues[$i]->description;
            $idStatus = $json->issues[$i]->status->id;
            $idPriorite = $json->issues[$i]->priority->id;
            $idTracker = $json->issues[$i]->tracker->id;
            $idUser = $json->issues[$i]->author->id;
            $idProject = $json->issues[$i]->project->id;
            $dateCree = $json->issues[$i]->created_on;
            try {
                $dateFin = NULL;
            }catch(Exception $e){
                $dateFin = NULL;
            }
            $dateModif = $json->issues[$i]->updated_on;

            $res_insert = $bdd->insertTicket($idTicket, $subject, $description, $idStatus, $idPriorite, $idTracker, $idUser, $idProject, $dateCree, $dateFin, $dateModif);
        }
    }
    $bdd->endTransaction($res_drop,$res_insert);
}

function getUser($apikey, $conf){

    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);
    $response = $client->request('GET', 'http://www.hostedredmine.com/projects/ulco2016project1/memberships.json',
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json = json_decode($response->getBody());

    $nbElements  = $json->{'total_count'};

    for ($i=0; $i<$nbElements; $i++) {

        $idUser = $json->memberships[$i]->user->id;

        $bdd = new Bdd($conf);
        $verif = $bdd->getUserExist($idUser);

        if ($verif == 0) {

            $name = $json->memberships[$i]->user->name;
            $group_id = $json->memberships[$i]->roles[0]->id;

            $bdd->insertUser($idUser, $name, $group_id);
        }
    }
}
