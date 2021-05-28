<?php
$path = "../storage/";
session_start();
foreach (scandir($path)as $fichier){
    if (is_dir($path.$fichier) && !($fichier == "." || $fichier == ".." )){
        $codeToDisplay = "<div id='".substr($path.$fichier,11)."' class='dossier'><img  src='../icons/folder.png' title='Dossier'>".$fichier."</div>";

        if ($_SESSION['user'] != 'Admin'){
            include "../bdd.php";
            $idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = '$fichier'")->fetch()['id'];
            $checkGroupeUser = $dbh -> query("SELECT * FROM linkuserstogroup WHERE idUser=\"".$_SESSION['idUser']."\" AND idGroupe=\"".$idGroupe."\"");
//            echo $fichier." / ".$nomGroupe."<br>";
            if ($checkGroupeUser->rowCount() > 0){
                echo $codeToDisplay;
                displaySousDossier($path.$fichier."/");
            }
        }else {
            echo $codeToDisplay;
            displaySousDossier($path.$fichier."/");
        }
    }
}

function displaySousDossier($path){
    $FolderAlreadyFind = false;
    foreach (scandir($path)as $fichier){
        if (is_dir($path.$fichier) && !($fichier == "." || $fichier == ".." )){
            $codeToDisplay = "<div id='".substr($path.$fichier,11)."' class='dossier'><img  src='../icons/folder.png' title='Dossier'>".$fichier."</div>";


            if (!$FolderAlreadyFind){
                echo "<div class='dossierClick' style='padding-left: 20px'>";
                $FolderAlreadyFind = true;
            }
            echo $codeToDisplay;
            displaySousDossier($path.$fichier."/");
        }
    }
    if ($FolderAlreadyFind){
        echo "</div>";
    }
}
echo "<script>dossierClick()</script>";