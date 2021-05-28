<?php
include "bdd.php";
session_start();
//ini_set("upload_max_filesize","2M");
$ds          = DIRECTORY_SEPARATOR;  //1
$groupe = $_GET['groupe'];
$storeFolder = 'storage/'.$groupe;   //2

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

    $nomFichier = $_FILES['file']['name'];
    $targetFile =  $targetPath. $nomFichier;  //5

    if (move_uploaded_file($tempFile,$targetFile)){
        $dbh->query("INSERT INTO fichier(nom,proprietaire,date,groupe) VALUES (\"" . $nomFichier . "\",\"" . $_SESSION['user'] . "\",\"" . date("Y-m-d") . "\",\"" . $groupe . "\")");
    } //6

}
?>