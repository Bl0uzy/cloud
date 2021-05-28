<?php
include "../bdd.php";
$idUser = $_GET['idUser'];
$idGroupe = $_GET['idGroupe'];
$existeDeja = false;
foreach ($dbh->query("SELECT * FROM linkuserstogroup WHERE idUser = '$idUser'") as $groupe){
    if ($groupe['idGroupe'] == $idGroupe){
        $existeDeja = true;
    }
}
if (!$existeDeja){
    $dbh->query("INSERT INTO linkuserstogroup(idUser,idGroupe) VALUES ('$idUser',$idGroupe)");
}
