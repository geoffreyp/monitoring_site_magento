<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helper/Bdd.php';

use GuzzleHttp\Client;

function getNumberCommits() {
    $client = new GuzzleHttp\Client();
    $response = $client->request('GET', 'https://gitlab.com/api/v3/projects/2120138/repository/commits',
    ['query' =>['private_token' => '8uhYCP3W1EyKxcYf-H63'],
        'verify'=>false]);

    $res =json_decode($response->getBody());
    $res = count($res);


    return $res;

}

function getNumberCommitsByDeveloppeur() {
    $client = new GuzzleHttp\Client();
    $response = $client->request('GET', 'https://gitlab.com/api/v3/projects/2120138/repository/commits',
        ['query' =>['private_token' => '8uhYCP3W1EyKxcYf-H63'],
            'verify'=>false]);

    $commits =json_decode($response->getBody());
    $users = array();
    // RECUP ALL USER
    foreach ($commits as $commit) {
        if (!in_array($commit->author_name,$users)) {
         array_push($users,$commit->author_name);
        }
    }

    $nbCommitsByUser = array();
    // RECUP COMMITS BY USER
    foreach($users as $user) {
        $nbCommits = 0;
        foreach ($commits as $commit) {
            if ($commit->author_name == $user) {
                $nbCommits++;
            }
        }
        array_push($nbCommitsByUser, [$nbCommits , $user]);
    }
    var_dump($nbCommitsByUser);
    //return $res;
}


function getCommits() {
    $client = new GuzzleHttp\Client();

    $bdd = new Bdd();

    $response1 = $client->request('GET', 'https://gitlab.com/api/v3/projects',
        ['query' =>['private_token' => '8uhYCP3W1EyKxcYf-H63'],
            'verify'=>false]);


    $json1 =json_decode($response1->getBody());

    $nbProjects  = count($json1);


    for ($i=0; $i<$nbProjects; $i++) {

        $idProject = $json1[$i]->id;

        $verifProject = $bdd->getCommitExist($idProject);


        if ($verifProject == 0) {

            $projectName = $json1[$i]->name;


            $bdd->insertGitlabProject($idProject, $projectName);


            $response2 = $client->request('GET', 'https://gitlab.com/api/v3/projects/'.$idProject.'/repository/commits',
                ['query' =>['private_token' => '8uhYCP3W1EyKxcYf-H63'],
                    'verify'=>false]);


            $json2 =json_decode($response2->getBody());

            $nbCommits  = count($json2);

            for ($j=0; $j<$nbCommits; $j++) {

                $idCommit = $json2[$j]->id;

                $verifCommit = $bdd->getCommitExist($idCommit);

                if ($verifCommit == 0) {

                    $titre = $json2[$j]->title;
                    $authorName = $json2[$j]->author_name;
                    $authorEmail = $json2[$j]->author_email;
                    $message = $json2[$j]->message;
                    $datecre = $json2[$j]->created_at;

                    $bdd->insertGitlabCommit($idCommit, $titre, $authorName, $authorEmail, $message, $datecre, $idProject);
                }


            }

        }

    }

}
getCommits();