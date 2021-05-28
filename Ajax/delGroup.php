<?php
include "../bdd.php";
$idGroupe = $_GET['id'];
//$idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = '$nom'")->fetch()['id'];
$nomGroupe = $dbh->query("SELECT * FROM groupe WHERE id = '$idGroupe'")->fetch()['nom'];
$dbh->query("DELETE FROM groupe WHERE id='$idGroupe'");
$dbh->query("DELETE FROM linkuserstogroup WHERE idGroupe='$idGroupe'");

$path = "../storage/".$nomGroupe."/";
foreach (scandir($path)as $fichier){
    if (!($fichier == "." || $fichier == "..")){
        unlink($path.$fichier);
        $dbh->query("DELETE FROM droits WHERE nom='$path.$fichier'");
    }
}
rmdir($path);