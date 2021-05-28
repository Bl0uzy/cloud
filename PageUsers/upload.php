<?php
include "../bdd.php";
session_start();
if (!isset($_SESSION['idUser'])){
    header("Location: ../login.php");
}
if (isset($_POST['folder']) && $_POST['folder'] != null){
    echo $_POST['folder'];
    $_SESSION['uploadFolder'] = $_POST['folder'];
    header("Location: upload.php");
}
function displayFolder($path){
    foreach (scandir($path)as $fichier){
        if (is_dir($path.$fichier) && !($fichier == "." || $fichier == ".." )){
            $input = "<input hidden name='folder' type='text' value='".$path.$fichier."/"."'>";
            $button = "<button class='dossierUpload' type='submit'><img style='margin-right:10px; margin-top: -5px ' src='../icons/folder.png' title='Dossier'>".$fichier."</button>";
            $form = "<form action='upload.php' method='post'>".$input.$button."</form>";

//            $scriptToDisplay = "<div id='".$path.$fichier."/"."' class='dossier'><img  src='../icons/folder.png' title='Dossier'><a href='#'> ".$fichier."</a></div>";

            if ($_SESSION['user'] != 'admin'){
                include "../bdd.php";
                $idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = '$fichier'")->fetch()['id'];
                $checkGroupeUser = $dbh -> query("SELECT * FROM linkuserstogroup WHERE idUser=\"".$_SESSION['idUser']."\" AND idGroupe=\"".$idGroupe."\"");
//            echo $fichier." / ".$nomGroupe."<br>";
                if ($checkGroupeUser->rowCount() > 0){
                    if ($checkGroupeUser->fetch()['ecrire'] == 1){
                        echo $form;
                        displaySousDossier($path.$fichier."/");
                        echo "<br>";
                    }
                }
            }else{
                echo $form;
                displaySousDossier($path.$fichier."/");
                echo "<br>";
            }
        }
    }
}
function displaySousDossier($path){
    $FolderAlreadyFind = false;
    foreach (scandir($path)as $fichier){
        if (is_dir($path.$fichier) && !($fichier == "." || $fichier == ".." )){
            $input = "<input hidden name='folder' type='text' value='".$path.$fichier."/"."'>";
            $button = "<button class='dossierUpload' type='submit'><img style='margin-right:10px; margin-top: -5px ' src='../icons/folder.png' title='Dossier'>".$fichier."</button>";
            $form = "<form action='upload.php' method='post'>".$input.$button."</form>";
            if (!$FolderAlreadyFind){
                echo "<div style='padding-left: 20px'>";
                $FolderAlreadyFind = true;
            }
            echo $form;
//            echo substr($path.$fichier,strpos($path.$fichier,"/",5),strpos($path.$fichier,"/",strpos($path.$fichier,"/",5))-1);
            displaySousDossier($path.$fichier."/");
        }
    }
    if ($FolderAlreadyFind){
        echo "</div>";
    }
}


?>
<!doctype html>
<html lang="fr">
<head>
    <title>Upload</title>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Main CSS -->
    <link id="onyx-css" href="style.css" rel="stylesheet"

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/myStyle.css">
<!--    <link href="../css/dropzone.css" type="text/css" rel="stylesheet" />-->

    <link id="bootstrap-css" href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link id="dropzone-css" href="assets/css/dropzone.css" rel="stylesheet">

    <!-- Icons Library -->
    <link id="font-awesome-css" href="assets/css/font-awesome.min.css" rel="stylesheet">
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
            <table>
                <tr>
                    <td><a href="../deconnexion.php"><img src="../icons/logout.svg" style="width: 20px; margin-top: -3em; margin-left: 0em" alt="Deconnexion" title="Deconnexion"></a></td>
                    <td><h6 style="margin-top: -30px; margin-left: 20px"><?php
                            echo $dbh->query("SELECT * FROM users WHERE id =\"".$_SESSION['idUser']."\"")->fetch()["nom"];
                            ?></h6></td>
                </tr>
            </table>
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
                    <a href="upload.php">Upload</a>
                </li>
                <li>
                    <a href="fichiers.php">Fichiers</a>
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
        <h2 class="mb-4">Upload</h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Choisi un dossier
        </button>

        <!-- Modal pour choisir le dossier-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dossiers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
<!--                        Contenu de la modale-->
                        <?php
                        displayFolder("../storage/");
                        ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour créer un dossier-->
        <div class="modal fade" id="newFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouveau dossier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--Contenu de la modale-->
                        <label for="nameFolder">Nom du nouveau dossier :</label>
                        <input id="nameFolder" type="text">
                        <div id="messageNewFolder"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="validateNewFolderName" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <div <?php if (!isset($_SESSION['uploadFolder'])) echo "hidden"?>  class="wrapper">
            <section class="container-fluid inner-page">
                <div class="row">
                    <div class="full-dark-bg">
                        <!-- Files section -->
                        <h4 class="section-sub-title"><span>Envoyer</span> vos fichiers dans le dossier
                            <?php

                            if (isset($_SESSION['uploadFolder']))
                            {
                                $firstSubString = substr($_SESSION['uploadFolder'],strpos($_SESSION['uploadFolder'],"/",5)+1);

                                $groupName = substr($firstSubString,0,strpos($firstSubString,"/"));
                                $idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = '$groupName'")->fetch()['id'];
                                $_SESSION['idGroupeUpload'] = $idGroupe;

                                $idUser = $_SESSION['idUser'];
                                echo substr($_SESSION['uploadFolder'],10,-1);
                                if ($dbh->query("SELECT createFolder FROM linkuserstogroup WHERE idGroupe ='$idGroupe' AND idUser='$idUser'")->fetch()['createFolder']==1){
                                    echo "<img src='../icons/add-folder.png' alt='Nouveau dossier' title='Nouveau dossier' data-toggle=\"modal\" data-target=\"#newFolderModal\" style='margin-left: 10px' class='iconBtn'>";
                                }

                            } ?></h4>

                        <form action="../file-upload.php" method="post" class="dropzone files-container">
                            <div class="fallback">
<!--                                <input hidden name="path" value="--><?php //if (isset($_POST['folder'])) echo $_POST['folder']?><!--">-->
                                <input name="file" type="file" multiple />
                            </div>
                        </form>

                        <!-- Notes -->
<!--                        <span>Only JPG, PNG, PDF, DOC (Word), XLS (Excel), PPT, ODT and RTF files types are supported.</span>-->
                        <span>La taille maximale des fichiers est de 127MB.</span>

                        <!-- Uploaded files section -->
                        <h4 class="section-sub-title">Fichier envoyé (<span class="uploaded-files-count">0</span>)</h4>
                        <span class="no-files-uploaded">Aucun fichier envoyé pour l'instant.</span>

                        <!-- Preview collection of uploaded documents -->
                        <div class="preview-container dz-preview uploaded-files">
                            <div id="previews">
                                <div id="onyx-dropzone-template">
                                    <div class="onyx-dropzone-info">
                                        <div class="thumb-container">
                                            <img data-dz-thumbnail />
                                        </div>
                                        <div class="details">
                                            <div>
                                                <span data-dz-name></span> <span data-dz-size></span>
                                            </div>
                                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                            <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                            <div class="actions">
                                                <a href="#!" data-dz-remove><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Warnings -->
                        <div id="warnings">
                            <span>Warnings will go here!</span>
                        </div>

                    </div>
                </div><!-- /End row -->

            </section>

        </div>
    </div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/bootstrap.min.js"></script>


<!-- JQuery -->
<script src="assets/js/jquery-1.10.2.min.js"></script>

<!-- Dropzone JS -->
<script src="assets/js/dropzone.min.js"></script>

<!-- Main JS file -->
<script src="assets/js/scripts.js"></script>
</body>
</html>