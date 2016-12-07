<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helper/Bdd.php';

use GuzzleHttp\Client;

function checkNotification($apikey){
    $bdd = new Bdd();
    $client = new GuzzleHttp\Client(['base_uri' => 'http://www.hostedredmine.com/']);
    $response = $client->request('GET', 'http://www.hostedredmine.com/issues.json?project_id=43188&status_id=opened',
        ['headers' => ['X-Redmine-API-Key' => $apikey]]);

    $json = json_decode($response->getBody());
    $notifs = $bdd->getActiveNotification();
    foreach ($json->{'issues'} as $issue){

        if($issue->{"status"}->{"id"} == 1 && $issue->{"priority"}->{"id"} >5){

            $dapi = DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $issue->{"created_on"});

            $notificationExist = false;
            $alert8 = false;
            foreach ($notifs as $n){
                $dbdd = new DateTime($n["date"]);

                if($dapi == $dbdd){
                    $notificationExist = true;
                }
            }

            $date_sub8 = new DateTime($dapi->format("Y-m-d H:i:s"));
            $date_sub8->add(new DateInterval('PT8H'));
            $now = new DateTime();

            if($now > $date_sub8){
                $alert8 = true;
            }

            if(!$notificationExist && $alert8){
                echo "insertion";
                $bdd->insertNotification($issue->{"id"}, 1, $dapi->format("Y-m-d H:i:s"),1);
            }

        }
    }
}
