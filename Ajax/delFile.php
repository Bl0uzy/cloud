<?php
session_start();
include "../bdd.php";
$idFichier = $_GET['idFichier'];
$nomFichier = $_GET['nomFichier'];
$groupe = $_GET['groupe'];
$path = "../logs/addFile/".date("Y-m-d").".txt";

if(unlink("../storage/".$groupe."/".$nomFichier)){
    //Log
    $content = date("H:i")." : ".$_SESSION['user']." -> "."suppresion du fichier \"".$nomFichier."\" dans le dossier \"".$groupe."\" reussi"."\n";
    $log = fopen($path,"a+");
    fputs($log,$content);
    fclose($log);
} else{
    //Log
    $content = date("H:i")." : ".$_SESSION['user']." -> "."suppresion du fichier \"".$nomFichier."\" dans le dossier \"".$groupe."\" échouée"."\n";
    $log = fopen($path,"a+");
    fputs($log,$content);
    fclose($log);
}
$dbh->query("DELETE FROM fichier WHERE id='$idFichier' ");
