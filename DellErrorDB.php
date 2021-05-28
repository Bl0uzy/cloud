<?php
include "bdd.php";
foreach ($dbh->query("SELECT * FROM fichier")as $fichierBD){
    if (file_exists("storage/".$fichierBD['groupe']."/".$fichierBD['nom'])){
        echo "Le fichier \"".$fichierBD['nom']."\" existe <br>";
        if ($fichierBD['path']==null || $fichierBD['path']==""){
            $dbh->query("UPDATE fichier SET path=\"".$fichierBD['groupe']."\" WHERE id =".$fichierBD['id']);
            echo "Fichier \"".$fichierBD['nom']."\" modifié dans la bdd <br>";
        }
    } else{
        echo "Le fichier \"".$fichierBD['nom']."\" n'existe pas. <br>";
        $dbh->query("DELETE FROM fichier WHERE id =".$fichierBD['id']);
    }
}
