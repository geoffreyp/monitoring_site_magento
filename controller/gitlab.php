<?php
/**
 * Created by PhpStorm.
 * User: Priams
 * Date: 08/12/2016
 * Time: 09:40
 */

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