<?php
/**
 * Created by PhpStorm.
 * User: johann
 * Date: 07/12/16
 * Time: 13:58
 */
    include "redmine.php";
    include "../helper/loadConf.php";

    $bdd = new Bdd($conf);

    if(isset($_GET['ticket'])) {
        getTicket("c232cdf169899c7c6074eecf42f7827ae37be34e", $conf);
    }

    if(isset($_GET['utilisateur'])) {
        getUser("c232cdf169899c7c6074eecf42f7827ae37be34e", $conf);
    }

    if(isset($_GET['data'])) {
        $tab = array();
        $ticketOpened = $bdd->getNbTicketOpened();
        $ticketClosedToday = $bdd->getNbTicketClosedToday();
        $ticketClosedMonth = $bdd->getNbTicketClosedThisMonth();

        $ticketManager = $bdd->getNbTicketOpenedByGroup("Manager");
        $ticketDevelopper = $bdd->getNbTicketOpenedByGroup("Developer");

        $ticketNew = $bdd->getNbTicketByStatusId(1);
        $ticketAssigned = $bdd->getNbTicketByStatusId(2);
        $ticketResolved = $bdd->getNbTicketByStatusId(3);
        $ticketBlocked = $bdd->getNbTicketByStatusId(7);
        $ticketInProgress = $bdd->getNbTicketByStatusId(8);

        array_push($tab,$ticketOpened,$ticketClosedToday,$ticketClosedMonth,$ticketManager,$ticketDevelopper,$ticketNew,$ticketAssigned,$ticketResolved,$ticketBlocked,$ticketInProgress);
        echo(json_encode($tab));
    }
?>