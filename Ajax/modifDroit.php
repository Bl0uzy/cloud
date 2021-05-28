<?php
include "../bdd.php";
$vDroit = $_GET['vDroit'];
$droit = $_GET['droit'];
$idLink = $_GET['idLink'];
echo $droit;
if ($droit == "effacer"){
    $dbh->query("UPDATE linkuserstogroup SET effacer='$vDroit' WHERE id = '$idLink'");
} elseif ($droit == "ecrire"){
    $dbh->query("UPDATE linkuserstogroup SET ecrire='$vDroit' WHERE id = '$idLink'");
} elseif ($droit == "ecraser"){
    $dbh->query("UPDATE linkuserstogroup SET ecraser='$vDroit' WHERE id = '$idLink'");
}elseif ($droit == "createFolder"){
    $dbh->query("UPDATE linkuserstogroup SET createFolder='$vDroit' WHERE id = '$idLink'");
}
