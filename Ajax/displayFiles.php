<?php
include "../bdd.php";

session_start();
$dossier = $_GET['dossier'];
$groupe = $_GET['dossier'];
if (strpos($dossier,"/")){
    $groupe= substr($dossier,0,strpos($dossier,"/"));
}
$path = "../storage/".$dossier."/";
$i = 0;

foreach (scandir($path) as $nomFichier){
    if (!($nomFichier == "." || $nomFichier == "..")){
        if(!is_dir($path.$nomFichier)){
            $fichier = $dbh ->query("SELECT * FROM fichier WHERE nom = \"".addslashes($nomFichier)."\" AND path = '$dossier'")->fetch();
//        ligne
            echo "<tr id='".$i."' class='toDel ";
            $delai1 = date('Y-m-d',strtotime("-8 days"));
//            $delai = new DateTime($delai1);
//            if (date("Y-m-d",filemtime($path.$nomFichier))<=$delai1){
//                echo "old";
//            }
            echo "'>";
            $i++;
//        Nom du fichier
            echo "<td id='".$dossier."'>";
            if ($_SESSION['user']!='Admin'){
                $idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = '$groupe'")->fetch()['id'];
                $droits =  $dbh->query("SELECT * FROM linkuserstogroup WHERE idUser =\"".$_SESSION['idUser']."\" AND idGroupe =\"".$idGroupe."\"")->fetch();
                if ($droits['effacer']==true || $fichier['proprietaire'] == $_SESSION['user']){
                    echo "<img id='".$fichier['id']."' style='margin-right : 4px' class='iconBtn delFile' src=\"../icons/delete.png\" alt=\"Supprimer\" title=\"Supprimer le fichier\" >";
                }
            }else echo "<img id='".$fichier['id']."' style='margin-right : 4px' class='iconBtn delFile' src=\"../icons/delete.png\" alt=\"Supprimer\" title=\"Supprimer le fichier\" >";
//            echo "<img src='../icons/share.png' alt='Partager' title='Partager' style='margin-right : 4px' class='iconBtn share'>";
            echo"<a href='../telecharger.php?chemin=".$dossier."/".$nomFichier."'>".$nomFichier."</a>";
            $file_ext = substr(strrchr($nomFichier, '.'), 1);
            if ($file_ext == "mp3" || $file_ext == "ogg" || $file_ext == "wav" || $file_ext == "WAV"){
                echo "<audio preload='none' id=\"audioPlayer\" controls src='../getSong.php?path=storage/".$dossier."/".$nomFichier."'></audio>";
            }
            echo "</td>";


//            echo "<td style='padding-right: 10px'>".date("d-m-Y",strtotime($fichier['date']))."</td>";
            echo "<td style='padding-right: 10px'>".date("d-m-Y",filemtime($path.$nomFichier))."</td>";

            echo "<td>".round(filesize($path.$nomFichier)*0.001)." Ko</td>";

            echo "<td>".$fichier['proprietaire']."</td>";


            echo "</tr>";
        }


    }
}

