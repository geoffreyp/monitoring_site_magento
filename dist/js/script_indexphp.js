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



$(document).ready(function () {
    setInterval(ajax_insertion_donnee,1000*60*5); //Mettre le nombre de secondes voulues(ici 10) par 1000
    setInterval(ajax_insertion_user,1000*60*5); //Mettre le nombre de secondes voulues(ici 10) par 1000
});