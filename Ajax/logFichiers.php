<?php
$dateDebut = $_GET['dateDebut'];
$dateFin =$_GET['dateFin'];
$path = "../logs/addFile/";
foreach (scandir($path)as $fichier){
    if (!($fichier == "." || $fichier == "..")){
        $datefichier = substr($fichier,0,-4);
        if ($dateDebut<= $datefichier && $datefichier<= $dateFin){
            $displayDatefichier = date("d-m-Y",strtotime($datefichier));
            echo "<strong>".$displayDatefichier."</strong>"."<br>";
            $file = file($path.$fichier);
            foreach ($file as $ligne){
                echo $ligne."<br>";
            }
        }
    }
}