$(document).ready(displayFolder());

function dossierClick(){
    $(".dossier").click(function () {
        var folder = $(this).attr('id');
        displayFiles(folder);

    });
}



function displayFolder() {
    $.ajax({
        url:"../Ajax/displayFolder.php",
        success : function (retour,statut) {
            $("#dossiers").html(retour)
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
}

function displayFiles(folder) {
    $.ajax({
        url:"../Ajax/displayFiles.php",
        data :"dossier="+folder,
        success : function (retour,statut) {
            console.log(retour);
            $(".toDel").remove();
            $("#topFichier").parent().append(retour);
            clickDelFile();
            clickShare();
        },
        error : function (result,status,erreur) {
            console.log(erreur)
        }
    })
}

function clickDelFile() {
    $(".delFile").unbind().click(function () {
        var idFichier = $(this).attr('id');
        var nomFichier = $(this).parent().text();
        var iFichier = $(this).parent().parent().attr('id');
        var groupe = $(this).parent().attr('id');

        if (confirm("Supprimer le fichier \""+nomFichier+"\"")){
            $.ajax({
                url:"../Ajax/delFile.php",
                data :"idFichier="+idFichier+"&nomFichier="+nomFichier+"&groupe="+groupe,
                success : function (retour,statut) {
                    // console.log(retour);
                    $("#"+iFichier).remove();
                },
                error : function (result,status,erreur) {
                    console.log(erreur)
                }
            })
        }

    })
}

function clickShare() {
    $(".share").unbind().click(function () {
        var nomFichier = $(this).parent().text();
        var groupe = $(this).parent().attr('id')
        console.log(groupe);
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(test).select();
        document.execCommand("copy");
        $temp.remove();
    })
}

// function clickPlay() {
//     $(".play").unbind().click(function () {
//         var nomFichier = $(this).parent().text();
//         var groupe = $(this).parent().attr('id');
//
//     })
// }