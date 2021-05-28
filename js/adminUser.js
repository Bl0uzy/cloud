$(".delUser").click(function () {
    var user = $(this).parent().text();
    if (confirm("Vous allez supprimer l'utisateur "+user)){
        var id  = $(this).parent().parent().attr('id');
        $.ajax({
            url:"../Ajax/delUser.php",
            type:"get",
            data : "id="+id,
            success : function (retour,statut) {
                console.log(statut);
                $("#"+id).remove();
            },
            error : function (result,status,erreur) {
                console.log(erreur)
            }
        })
    }
});


$(".voirMdp").click(function () {
    if ($(this).prev('input').attr('type') == "password"){
        $(this).prev('input').attr('type','texte')
    } else $(this).prev('input').attr('type','password')
});

$(".modifMdp").click(function () {
    var id  = $(this).parent().parent().attr('id');
    var mdp = $(this).prev().prev('input').val();

    $.ajax({
        url:"../Ajax/modifMdp.php",
        type:"get",
        data : "id="+id+"&mdp="+mdp,
        success : function (retour,statut) {
            console.log(statut);
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
});

$(".group").change(function () {
    var selectElem = $(this);
    var idGroupe = $(this).val();
    var idLink = $(this).attr('id');
    $.ajax({
        url:"../Ajax/modifGroup.php",
        type:"get",
        data : "idGroupe="+idGroupe+"&idLink="+idLink,
        success : function (retour,statut) {
            // console.log(statut);
            if (idGroupe == 0){
                selectElem.remove()
            }
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
});

$(".addGroupe").click(function () {
    var selectElem = $(this);
    $.ajax({
        url:"../Ajax/createSelectGroup.php",
        success : function (retour,statut) {
            // console.log(retour);
            selectElem.before(retour);
            newGroupe()
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
});

function newGroupe() {
    $(".newGroup").change(function () {
        var selectElem = $(this);
        var idUser = $(this).parent().parent().attr('id');
        var idGroupe = $(this).val();
        $.ajax({
            url:"../Ajax/newGroupe.php",
            data:"idUser="+idUser+"&idGroupe="+idGroupe,
            success : function (retour,statut) {
                console.log(statut);
                location.reload()
            },
            error : function (result,status,erreur) {
                console.log(erreur)
            }
        })
    })
}