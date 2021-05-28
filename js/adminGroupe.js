$(".delGroupe").click(function () {
    // console.log();
    var nomGroupe = $(this).parent().text();

    if (confirm("Vous allez supprimer le groupe"+nomGroupe+", ainsi que tous ses fichiers")){
        var idGroupe = $(this).attr('id');
        console.log(idGroupe)
        $.ajax({
            url:"../Ajax/delGroup.php",
            data: "id="+idGroupe,
            success : function (retour,statut) {
                document.location.reload();
                console.log(retour)
            },
            error : function (result,status,erreur) {
                console.log(erreur)
            }
        })
    }

});

$(".news").click(function () {
    // console.log($(this).parent().attr("id"));
    var nomGroupe = $(this).parent().text();
    console.log(nomGroupe)
    $("#modifGroupLabel").text(nomGroupe);
    $.ajax({
        url:"../Ajax/displayContentGroup.php",
        data: "nom="+nomGroupe,
        success : function (retour,statut) {
            $("#contentGroup").html(retour);
            console.log(statut)
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
});

$(".checkBoxDroit").change(function () {
    var vDroit;
    if ($(this).is(":checked")){
        vDroit = 1;
    } else vDroit = 0;
    console.log(vDroit);

    var droit = $(this).parent().attr("class");
    var idLink = $(this).parent().parent().attr('id');
    $.ajax({
        url:"../Ajax/modifDroit.php",
        data: "vDroit="+vDroit+"&droit="+droit+"&idLink="+idLink,
        success : function (retour,statut) {
            console.log(statut);
            console.log(retour)
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
})
