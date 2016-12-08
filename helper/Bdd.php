<?php

class Bdd{
    private $bdd;
    function __construct(){
        try
        {
            $this->bdd = new PDO('mysql:host=localhost:8889;dbname=monitoring;charset=utf8', 'root', 'root');
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

    function insertUser($id, $name, $group_id){
        $req = $this->bdd->prepare('INSERT INTO utilisateur(id, name, group_id) VALUES(:id, :name, :group_id)');
        $req->execute(array(
            'id' => $id,
            'name' => $name,
            'group_id' => $group_id
        ));
    }


    function getUserExist($id){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM utilisateur WHERE id ='.$id)->fetchColumn();

        return $resp;
    }


    function getNbTicketOpened(){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE statut_id NOT IN (5,6)')->fetchColumn();

        return $resp;
    }

    function getNbTicketClosedToday(){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE substr(date_cree,1,10) = str_to_date(sysdate(),"%Y-%m-%d") AND statut_id IN (5,6)')->fetchColumn();

        return $resp;
    }

    function getNbTicketClosedThisMonth(){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE substr(date_cree,6,2) = month(now()) AND statut_id IN (5,6)')->fetchColumn();

        return $resp;
    }

    function getNbTicketOpenedByGroup($group){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket AS t, utilisateur AS u, groupe AS g WHERE t.statut_id NOT IN (5,6) AND t.user_id = u.id AND u.group_id = g.id AND g.name = \''.$group.'\' GROUP BY u.group_id')->fetchColumn();

        return $resp;
    }

    function getNbTicketByStatus($status){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket AS t, statut AS s WHERE t.statut_id = s.id AND s.name = \''.$status.'\'')->fetchColumn();

        return $resp;
    }

    function getNbTicketByStatusId($id_status){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE statut_id ='.$id_status)->fetchColumn();

        return $resp;
    }

    function getVerifConnexion($email, $password){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM connexion WHERE email = \''.$email.'\' AND password = \''.$password.'\'')->fetchColumn();

        return $resp;
    }



}

?>


