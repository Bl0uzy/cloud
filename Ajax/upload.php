<?php

//upload.php

//$folder_name = 'upload/';
//
//if(!empty($_FILES))
//{
//    $temp_file = $_FILES['file']['tmp_name'];
//    $location = $folder_name . $_FILES['file']['name'];
//    move_uploaded_file($temp_file, $location);
//}
//
//if(isset($_POST["name"]))
//{
//    $filename = $folder_name.$_POST["name"];
//    unlink($filename);
//}
//
//$result = array();
//
//$files = scandir('../storage/');
//
//$output = '<div class="row">';
//
//if(false !== $files)
//{
//    foreach($files as $file)
//    {
//        if('.' !=  $file && '..' != $file)
//        {
//            $output .= '
//   <div class="col-md-2">
//    <img src="'.$folder_name.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
//    <button type="button" class="btn btn-link remove_image" id="'.$file.'">Remove</button>
//   </div>
//   ';
//        }
//    }
//}
//$output .= '</div>';
//echo $output;

if (isset($_FILES['upload']['name'])){
            if (isset($_POST['groupe'])) {

                $total = count($_FILES['upload']['name']);
//            echo $_POST['groupe'];

                // Loop through each file
                for ($i = 0; $i < $total; $i++) {

                    //Get the temp file path
                    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                    //Make sure we have a file path
                    if ($tmpFilePath != "") {
                        //Setup our new file path
                        $newFilePath = "../storage/" . $_POST['groupe'] . "/" . $_FILES['upload']['name'][$i];

                        if (file_exists($newFilePath)) {
                            $idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = \"" . $_POST['groupe'] . "\"")->fetch()['id'];
                            $droits = $dbh->query("SELECT * FROM linkuserstogroup WHERE idUser =\"" . $_SESSION['idUser'] . "\" AND idGroupe =\"" . $idGroupe . "\"")->fetch();
                            if ($droits['ecraser'] == "1") {
                                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                                    echo "Le fichier", $_FILES['upload']['name'][$i], " a été envoyé et a écrasé l'ancien <br>";
                                    $dbh->query("INSERT INTO fichier(nom,proprietaire,date,groupe) VALUES (\"" . $_FILES['upload']['name'][$i] . "\",\"" . $_SESSION['user'] . "\",\"" . date("Y-m-d") . "\",\"" . $_POST['groupe'] . "\")");

                                } else echo "Le fichier ", $_FILES['upload']['name'][$i], "n'a pas réussi a s'envoyer";
                            } else echo "Vous n'avez pas le droit d'écraser le fichier " . $_FILES['upload']['name'][$i];
                        } else {
                            //Upload the file into the temp dir
                            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                                echo "Le fichier", $_FILES['upload']['name'][$i], " a bien été envoyé !<br>";
                                $dbh->query("INSERT INTO fichier(nom,proprietaire,date,groupe) VALUES (\"" . $_FILES['upload']['name'][$i] . "\",\"" . $_SESSION['user'] . "\",\"" . date("Y-m-d") . "\",\"" . $_POST['groupe'] . "\")");

                            } else echo "Le fichier ", $_FILES['upload']['name'][$i], "n'a pas réussi a s'envoyer";
                        }
                    } else echo "Erreur";
                }
            }else echo "Choisis un groupe";
        }
?>