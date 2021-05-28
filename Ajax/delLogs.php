<?php
$date = $_GET['date'];
$path = "../logs/connexion/";
$path2="../logs/addFile/";
foreach (scandir($path)as $fichier){
    if (!($fichier == "." || $fichier == "..")){
        $datefichier = substr($fichier,0,-4);
        if ($datefichier< $date){
            unlink($path.$fichier);
        }
    }
}
foreach (scandir($path2)as $fichier){
    if (!($fichier == "." || $fichier == "..")){
        $datefichier = substr($fichier,0,-4);
        if ($datefichier< $date){
            unlink($path2.$fichier);
        }
    }
}