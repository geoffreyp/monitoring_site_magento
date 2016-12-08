<?php
/**
 * Created by PhpStorm.
 * User: johann
 * Date: 07/12/16
 * Time: 13:58
 */
    include "redmine.php";
    include "../helper/loadConf.php";

    if(isset($_GET['ticket'])) {
        getTicket("c232cdf169899c7c6074eecf42f7827ae37be34e", $conf);
    }

    if(isset($_GET['utilisateur'])) {
        getUser("c232cdf169899c7c6074eecf42f7827ae37be34e", $conf);
    }
?>