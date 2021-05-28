<?php
include "../bdd.php";
$idLink = $_GET['idLink'];
$idGroupe = $_GET['idGroupe'];
if ($idGroupe == ""){
    $dbh->query("DELETE FROM linkuserstogroup WHERE id='$idLink'");
}else {
    $dbh->query("UPDATE linkuserstogroup SET idGroupe =  '$idGroupe' WHERE id = '$idLink'");
}

