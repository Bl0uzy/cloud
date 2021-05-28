$("#dateFiltre").click(function () {
    var dateDebut = $("#dateDebut").val();
    var dateFin =$("#dateFin").val();
    $.ajax({
        url:"../Ajax/log.php",
        data:"dateDebut="+dateDebut+"&dateFin="+dateFin,
        success : function (retour,statut) {
            // console.log(retour);
            $("#logs").html(retour)
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
    $.ajax({
        url:"../Ajax/logFichiers.php",
        data:"dateDebut="+dateDebut+"&dateFin="+dateFin,
        success : function (retour,statut) {
            // console.log(retour);
            $("#logsFichier").html(retour)
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
});

$("#suppLogs").click(function () {
    console.log($(this).prev().val());
    var date = $(this).prev().val();
    $.ajax({
        url:"../Ajax/delLogs.php",
        data:"date="+date,
        success : function (retour,statut) {
            console.log(retour);
            console.log(statut);
            location.reload();
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
});