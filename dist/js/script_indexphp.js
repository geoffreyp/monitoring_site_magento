function ajax_insertion_donnee(){
    console.log('Call ajax_insertion_donne');
    $.ajax({
        url:'/controller/redmine_ajax.php',
        type:'GET',
        data:'ticket=1',
        success: function(){
            return true;
        }
    });
}

function ajax_check_notification(){
    console.log('Call ajax_check_notification');
    $.ajax({
        url:'/controller/redmine_ajax.php',
        type:'GET',
        data:'checkNotif=1',
        success: function(){
            return true;
        }
    });
}



$(document).ready(function () {
    setInterval(ajax_insertion_donnee,1000*60*5); //Mettre le nombre de secondes voulues(ici 10) par 1000
    setInterval(ajax_check_notification,1000*60*60);
});