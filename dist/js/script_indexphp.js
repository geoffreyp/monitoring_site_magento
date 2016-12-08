function ajax_insertion_donnee(){

    $.ajax({
        url:'/controller/redmine_ajax.php',
        type:'GET',
        data:'ticket=1',
        success: function(){
            return true;
        }
    });
}

function ajax_insertion_user(){
    $.ajax({
        url:'/controller/redmine_ajax.php',
        type:'GET',
        data:'utilisateur=1',
        success: function(){
            return true;
        }
    });
}

function ajax_reload_data(){
    $.ajax({
        url:'/controller/redmine_ajax.php',
        type:'GET',
        data:'data=1',
        success: function(data){
            console.log("ajax_reload_data");
            var tableau = JSON.parse(data);
            reload_data(tableau);
        }
    });
}

function reload_data(tableau){
    console.log("reload_data");
    $('#ticketOpened').html(tableau[0]);
    $('#ticketOpenedSpan').html(tableau[0]);
    $('#ticketClosedToday').html(tableau[1]);
    $('#ticketClosedMonth').html(tableau[2]);
    $('#ticketManager').html(tableau[3]);
    $('#ticketDeveloper').html(tableau[4]);
    $('#ticketNew').html(tableau[5]);
    $('#ticketAssigned').html(tableau[6]);
    $('#ticketResolved').html(tableau[7]);
    $('#ticketBlocked').html(tableau[8]);
    $('#ticketInProgress').html(tableau[9]);
}



$(document).ready(function () {
    setInterval(ajax_insertion_donnee,1000*60*5); //Mettre le nombre de secondes voulues(ici 10) par 1000
    setInterval(ajax_insertion_user,1000*60*5); //Mettre le nombre de secondes voulues(ici 10) par 1000
    setInterval(ajax_reload_data,1000*10); //Mettre le nombre de secondes voulues(ici 10) par 1000
});