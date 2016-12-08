<?php

class Bdd{
    private $bdd;
    function __construct(){
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=monitoring;charset=utf8', 'root', 'root');
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
        $res_insert = $req->execute(array(
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

        return $res_insert;

    }

    function beginTransaction(){

        $this->bdd->beginTransaction();
        $res_drop = $this->bdd->exec('TRUNCATE TABLE ticket');
        return $res_drop;
    }

    function endTransaction($res_drop,$res_insert){
        if($res_drop > 0 && $res_insert > 0){
            $this->bdd->commit();
        }else{
            $this->bdd->rollBack();
        }
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
        try{
            $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE statut_id NOT IN (5,6)')->fetchColumn();
        }catch (Exception $e){
            return 0;
        }


        return $resp;
    }

    function getNbTicketClosedToday(){
        try{
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE substr(date_cree,1,10) = str_to_date(sysdate(),"%Y-%m-%d") AND statut_id IN (5,6)')->fetchColumn();
        }catch (Exception $e){
            return 0;
        }
        return $resp;
    }

    function getNbTicketClosedThisMonth(){
        try{
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE substr(date_cree,6,2) = month(now()) AND statut_id IN (5,6)')->fetchColumn();
        }catch (Exception $e){
            return 0;
        }
        return $resp;
    }

    function getNbTicketOpenedByGroup($group){
        try{
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket AS t, utilisateur AS u, groupe AS g WHERE t.statut_id NOT IN (5,6) AND t.user_id = u.id AND u.group_id = g.id AND g.name = \''.$group.'\' GROUP BY u.group_id')->fetchColumn();
        }catch (Exception $e){
            return 0;
        }
        return $resp;
    }

    function getNbTicketByStatus($status){
        try{
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket AS t, statut AS s WHERE t.statut_id = s.id AND s.name = \''.$status.'\'')->fetchColumn();
        }catch (Exception $e){
            return 0;
        }
        return $resp;
    }

    function getNbTicketByStatusId($id_status){
        try{
        $resp = $this->bdd->query('SELECT COUNT(*) FROM ticket WHERE statut_id ='.$id_status)->fetchColumn();
        }catch (Exception $e){
            return 0;
        }
        return $resp;
    }

    function getVerifConnexion($email, $password){
        $resp = $this->bdd->query('SELECT COUNT(*) FROM connexion WHERE email = \''.$email.'\' AND password = \''.$password.'\'')->fetchColumn();

        return $resp;
    }



}

?>


