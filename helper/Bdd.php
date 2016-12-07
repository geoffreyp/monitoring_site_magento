<?php

class Bdd{
    private $bdd;
    function __construct(){
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=i2l;charset=utf8', 'root', 'toto');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    function insertNotification($name, $importance, $description=null){
        $req = $this->bdd->prepare('INSERT INTO notification(name, description, importance) VALUES(:name, :description, :importance)');
        $req->execute(array(
            'name' => $name,
            'description' => $description,
            'importance' => $importance
        ));
    }

    function getActiveNotification(){
        $resp = $this->bdd->query('SELECT * FROM notification');
        $result = [];
        while ($donnees = $resp->fetch())
        {
            $result[] = $donnees;
        }

        $resp->closeCursor();

        return $result;
    }
}

?>


