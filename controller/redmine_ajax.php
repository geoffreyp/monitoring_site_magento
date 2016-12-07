<?php
/**
 * Created by PhpStorm.
 * User: johann
 * Date: 07/12/16
 * Time: 13:58
 */
    require "redmine.php";
    require "notification.php";

    if(isset($_GET['ticket'])) {
        getTicket("c232cdf169899c7c6074eecf42f7827ae37be34e");
    }

    if(isset($_GET['checkNotif'])){
        echo "check notif";
        checkNotification("c232cdf169899c7c6074eecf42f7827ae37be34e");
    }
?>