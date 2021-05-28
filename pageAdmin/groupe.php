<?php
include "../bdd.php";
session_start();
if (!isset($_SESSION['idUser'])){
    header("Location: ../login.php");
} elseif ($_SESSION['user'] != "Admin"){
    header("Location: ../login.php");

}

if(isset($_POST['groupe'])){
    if ($_POST['groupe'] != ""){
        $test =$dbh->query("SELECT * FROM groupe WHERE nom =\"". $_POST['groupe'] . "\"");
        if ($test -> rowCount() == 0){ //Si le nom n'est pas deja pris
            $dbh ->query("INSERT INTO groupe(nom) VALUES (\"". $_POST['groupe'] ."\")");
            mkdir("../storage/".$_POST['groupe']);
        }
    }
}

if (isset($_POST['lienDoc'])){
//    echo "<iframe src='".$_POST['lienDoc']."?embedded=true'></iframe>";
    $dbh->query("UPDATE groupe SET docs = \"".$_POST['lienDoc']."\" WHERE id=\"".$_POST['idGroupe']."\"");
}
?>

<!doctype html>
<html lang="fr">
<head>
    <title>Groupe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/myStyle.css">
    <?php
    if (is_file("../panel/customColor.css")){
        echo "<link rel='stylesheet' href='../panel/customColor.css'>";
    }
    ?>
</head>
<body>

<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4 pt-5">
            <a href="../deconnexion.php"><img src="../icons/logout.svg" style="width: 20px; margin-top: -3em; margin-left: 0em" alt="Deconnexion" title="Deconnexion"></a>

            <?php
            $files = scandir("../panel/");
            $logoFind = false;
            foreach ($files as $file) {
                if ($file !="." && $file!=".." && strpos($file,"logo")===0){
                    $logoFind = true;
                    echo "<img class='logo' src='../panel/$file'><p></p>";
                }
            }
            if ($logoFind == false){
                echo '<h1><a class="logo">LATITUDE</a></h1>';
            }
            ?>            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="users.php">Utilisateurs</a>
                </li>
                <li>
                    <a href="groupe.php">Groupes</a>
                </li>
                <li>
                    <a href="fichiers.php">Fichiers</a>
                </li>
                <li>
                    <a href="panel.php">Panel</a>
                </li>
                <li>
                    <a href="logs.php">Logs</a>
                </li>
            </ul>

            <div class="footer">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Groupe</h2>
        <table id="groupTable">
            <?php
            echo "<table id='contentGroupeTableau'><tr>
                    <td></td>
                    <td>Ecrire</td>
                    <td>Effacer</td>
                    <td>Ecraser</td>
                    <td>Créer un groupe</td>
             </tr></table>
             ";
            foreach ($dbh -> query("SELECT * FROM groupe") as $row){
//                echo "<tr id='".$row['nom']."'>";
                echo "<h6> <img id=".$row['id']." class='iconBtn delGroupe' style='margin-right: 5px' src=\"../icons/delete.png\" alt=\"Supprimer\" title=\"Supprimer le groupe\"  ><img data-toggle=\"modal\" data-target=\"#modifGroup\" class='iconBtn news' style='margin-right: 5px' src='../icons/worldwide.png' title='News' alt='News'><td>".$row['nom']."</h6></td>" ;
                $nomGroupe = $row['nom'];
                $idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = '$nomGroupe'")->fetch()['id'];

                echo "<table id='contentGroupeTableau'><tr>
                    
             ";
                foreach ($dbh->query("SELECT * FROM linkuserstogroup WHERE idGroupe='$idGroupe'") as $link){
                    echo "<tr id=".$link['id'].">
            <td>".$dbh->query("SELECT * FROM users WHERE id= \"".$link['idUser']."\"")->fetch()['nom']."</td>
            <td class='ecrire'><input";
                    if ($link['ecrire']==1){
                        echo " checked ";
                    }
                    echo " class='checkBoxDroit' type='checkbox'></td>
            <td class='effacer'><input";
                    if ($link['effacer']==1){
                        echo " checked ";
                    }
                    echo " class='checkBoxDroit' type='checkbox'></td> 
            <td class='ecraser'><input";

                    if ($link['ecraser']==1){
                        echo " checked ";
                    }
                    echo " class='checkBoxDroit' type='checkbox'></td>";

                    echo "<td class='createFolder'><input";
                    if ($link['createFolder']==1){
                        echo " checked ";
                    }
                    echo " class='checkBoxDroit' type='checkbox'></td>";



                    echo "</tr>";
                }
                echo "</table><hr>";

            }
            ?>
            <tr>
                <form method="post">
                    <fieldset id="fieldsetNewGroup">
                        <legend>Ajouter un groupe</legend>
                        <td style="width: 50%">
                            <input type="text" name="groupe" placeholder="Nom du groupe" >
                            <button class="btn"><img src="../icons/check-mark.png" alt="Ajouter" title="Ajouter"></button>
                        </td>
                    </fieldset>
                </form>
                <div id="msgErreur"></div>
                <div>

                    <!-- Modal -->
                    <div class="modal fade" id="modifGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modifGroupLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="contentGroup" class="modal-body">
                                    ...
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </tr>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/adminGroupe.js"></script>


</body>
</html>