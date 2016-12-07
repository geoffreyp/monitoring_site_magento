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

    function insertNotification($name, $importance, $date, $active, $description=null){
        $req = $this->bdd->prepare('INSERT INTO notification(name, description, importance, active, date) VALUES(:name, :description, :importance, :active, :date)');
        $res = $req->execute(array(
            'name' => $name,
            'description' => $description,
            'importance' => $importance,
            'date' => $date,
            'active' => $active
        ));

        var_dump($res);
    }

    function getActiveNotification(){
        $resp = $this->bdd->query('SELECT * FROM notification WHERE active=1');
        $result = [];
        if($resp){
            while ($donnees = $resp->fetch())
            {
                $result[] = $donnees;
            }
        }else{
            return [];
        }

        $resp->closeCursor();

        return $result;
    }


    function insertTicket($id, $subject, $description, $statut_id, $priorite_id, $tracker_id, $user_id, $project_id, $date_cree, $date_fin, $date_modif){
        $req = $this->bdd->prepare('INSERT INTO ticket(id, subject, description, statut_id, priorite_id, tracker_id, user_id, project_id, date_cree, date_fin, date_modif) VALUES(:id, :subject, :description, :statut_id, :priorite_id, :tracker_id, :user_id, :project_id, :date_cree, :date_fin, :date_modif)');
        $req->execute(array(
            'id' => $id,
            'subject' => $subject,
            'description' => $description,
            'statut_id' => $statut_id,
            'priorite_id' => $priorite_id,
            'tracker_id' => $tracker_id,
            'user_id' => $user_id,
            'project_id' => $project_id,
            'date_cree' => $date_cree,
            'date_fin' => $date_fin,
            'date_modif' => $date_modif
        ));
    }

    function getTicketExist($id){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE id ='.$id)->fetchColumn();

        return $resp;
    }



}
//$bdd = new Bdd();
//$bdd->insertTicket(619105, "Test status 7", "", 6, 4, 4, 58454, 43188, "2016-12-07T09:24:20Z", "2016-12-07T09:24:20Z", "2016-12-07T09:24:20Z");
//$bdd->getTicketExist(619105);
?>


