<?php
session_start();
$nameFolder = $_GET['nameFolder'];
$path = $_SESSION['uploadFolder'].$nameFolder."/";
if (is_dir($path)) {
    echo 'Le répertoire existe déjà!';
}
// Création du nouveau répertoire
else {
    mkdir($path);
    $_SESSION['uploadFolder']= $path;
    echo 'refresh';
}