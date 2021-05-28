<?php
include "bdd.php";
if ($_POST['passw'] != "" && $_POST['user'] != ""){
    $checkPass = $dbh->query("SELECT * FROM users WHERE nom = \"".$_POST['user']." \"AND passw =\"".$_POST['passw']."\" ");
    if ($checkPass->rowCount() == 1){
        $user = $checkPass->fetchAll()[0];
        session_start();
        $_SESSION['user'] = ucfirst(strtolower($_POST['user']));
        $_SESSION['idUser'] = $user['id'];
        if ($_SESSION['user'] == 'Admin'){
            header("Location: pageAdmin/");
        }else {
            $path = "logs/connexion/".date("Y-m-d").".txt";

            $content = date("H:i")." : ".$_POST['user']."\n";
            $log = fopen($path,"a+");
            fputs($log,$content);
            fclose($log);

            header("Location: PageUsers/");
            echo "test";
        }
    } else header("Location: login.php?error=pswOrId");
} else header("Location: login.php?error=notFull");
