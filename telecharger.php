<?php
session_start();
$chemin = 'storage/' .$_GET['chemin'];
if (isset($_SESSION['user'])) {
    if (file_exists($chemin)) {
        $file_ext = substr(strrchr($chemin, '.'), 1);

        if ($file_ext == "pdf") {
            header('Content-Type: application/pdf');
        } else {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($chemin));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($chemin));
        }
//        header('Location: ' . $chemin);
//    echo 'Location: ' . $chemin;

        readfile($chemin);
        exit;

    }
}else header('Location: login.php');
?>