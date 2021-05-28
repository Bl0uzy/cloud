<?php
include "../bdd.php";

session_start();
if (!isset($_SESSION['idUser'])){
    header("Location: ../login.php");
} elseif ($_SESSION['user'] != "Admin"){
    header("Location: ../login.php");

}
header('Content-Description: File Transfer');
function findValue($file,$key){
    $step1=substr($file,strpos($file,$key));
    $step2 = substr($step1,0,strpos($step1,";"));
    $step3=substr($step2,strpos($step2,":")+1);
    if (strpos($step3,"!important")){
        $step3 = substr($step3,0,strpos($step3,"!important")-1);
    }

    return $step3;
}
if (isset($_GET['mainColor'])){
    $content = "#sidebar{
background:".$_GET['mainColor'].";
}
.btn.btn-primary{
background:".$_GET['secondColor'].";
border-color:".$_GET['secondColor'].";
}
.full-dark-bg{
background-color:".$_GET['secondColor'].";
}


";

    file_put_contents("../panel/customColor.css",$content);
    header("Location: panel.php");
}




?>
<!doctype html>
<html lang="fr">
<head>
    <title>Admin panel</title>
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
            ?>

            <ul class="list-unstyled components mb-5">
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

            </div>

        </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Panel</h2>
        <div class="panelContainer">
            <fieldset class="fieldsetPanel">
                <legend >Couleurs</legend>

                <?php
                if (is_file("../panel/customColor.css")){
                    $file = fopen("../panel/customColor.css","rb");
                    $fileContent = fread($file,filesize("../panel/customColor.css"));
//                    echo findValue($fileContent,"background");
//                    echo findValue($fileContent,"border-color");
                }
                ?>
                <form method="get" style="margin-left: 20px;margin-bottom: 20px">
                    <label for="mainColor"> Couleur principale :</label> <input value="<?php echo findValue($fileContent,"background");?>" name="mainColor" id="mainColor" type="color"><br>
                    <label for="secondColor"> Couleur secondaire : </label><input value="<?php echo findValue($fileContent,"border-color");?>" name="secondColor" id="secondColor" type="color">
                    <br><button class="btn btn-primary" type="submit">Valider</button>
                </form>

            </fieldset>
            <fieldset class="fieldsetPanel">
                <legend >Logo</legend>
                <form action="panel.php" method="post" enctype="multipart/form-data" style="margin-left: 20px">
                    Logo :
                    <input type="file" name="fileToUpload" id="fileToUpload"><p></p>
                    <input class="btn btn-primary" type="submit" value="Envoyer image" name="submit">
                </form>
                <?php
                if (isset($_FILES["fileToUpload"])){
                    $files = scandir("../panel/");
                    foreach ($files as $file) {
                        if ($file !="." && $file!=".." && $file!="customColor.css"){

                            unlink("../panel/$file");
                        }
                    }


                    $target_dir = "../panel/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $endNameFile = $target_dir."logo.".$imageFileType;

// Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
//                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "Le fichier n'est pas une image";
                            $uploadOk = 0;
                        }
                    }

// Check if file already exists
//                    if (file_exists($target_file)) {
//                        echo "Sorry, file already exists.";
//                        $uploadOk = 0;
//                    }


// Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        echo "Seul les formats JPG, JPEG, PNG & GIF sont accepté.";
                        $uploadOk = 0;
                    }

// Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $endNameFile)) {
                            echo "Le logo a bien été modifié";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                ?>

            </fieldset>
        </div>
    </div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>

</body>
</html>