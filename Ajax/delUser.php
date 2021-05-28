<?php
include "../bdd.php";
$idUser = $_GET['id'];
$dbh->query("DELETE FROM linkuserstogroup WHERE idUser ='$idUser'");
$dbh->query("DELETE FROM users WHERE id = '$idUser'");