<?php
include "../bdd.php";
$id = $_GET['id'];
$mdp = $_GET['mdp'];
$dbh->query("UPDATE users SET passw='$mdp' WHERE id='$id'");
