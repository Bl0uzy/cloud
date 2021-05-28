<?php
session_start();
include "bdd.php";

/**
 * Dropzone PHP file upload/delete
 */

// Check if the request is for deleting or uploading
$delete_file = 0;
if(isset($_POST['delete_file'])){
    $delete_file = $_POST['delete_file'];
}

$targetPath = dirname( __FILE__ ) . substr($_SESSION['uploadFolder'],2);
$path = "logs/addFile/".date("Y-m-d").".txt";


//fputs($log,$content);
//fclose($log);
// Check if it's an upload or delete and if there is a file in the form
if ( !empty($_FILES) && $delete_file == 0 ) {

    // Check if the upload folder is exists
    if ( file_exists($targetPath) && is_dir($targetPath) ) {

        // Check if we can write in the target directory
        if ( is_writable($targetPath) ) {

            /**
             * Start dancing
             */
            $tempFile = $_FILES['file']['tmp_name'];

            $targetFile = $targetPath . $_FILES['file']['name'];

            // Check if there is any file with the same name
            $groupName = $dbh->query("SELECT nom FROM groupe WHERE id ='".$_SESSION['idGroupeUpload']."'")->fetch()['nom'];

            if ( !file_exists($targetFile) ) {

                // Upload the file
                move_uploaded_file($tempFile, $targetFile);

                // Be sure that the file has been uploaded
                if ( file_exists($targetFile) ) {
                    $groupName = $dbh->query("SELECT nom FROM groupe WHERE id ='".$_SESSION['idGroupeUpload']."'")->fetch()['nom'];
//                    $groupName = "Groupe1";
                    $dbh->query("INSERT INTO fichier(nom,proprietaire,date,groupe,path) VALUES (\"" . $_FILES['file']['name'] . "\",\"" . $_SESSION['user'] . "\",\"" . date("Y-m-d") . "\",\"" . $groupName . "\",\"" . substr($_SESSION['uploadFolder'],11,-1) . "\")");

                    //Log
                    $content = date("H:i")." : ".$_SESSION['user']." -> "."uplaod du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" réussi"."\n";
                    $log = fopen($path,"a+");
                    fputs($log,$content);
                    fclose($log);

                    $response = array (
                        'status'    => 'success',
                        'info'      => 'Ton fichié a été envoyé avec succès.',
                        'file_link' => $targetFile
                    );
                } else {
                    //Log
                    $content = date("H:i")." : ".$_SESSION['user']." -> "."uplaod du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" échoué"."\n";
                    $log = fopen($path,"a+");
                    fputs($log,$content);
                    fclose($log);

                    $response = array (
                        'status' => 'error',
                        'info'   => 'Couldn\'t upload the requested file :(, a mysterious error happend.'
                    );
                }

            } else {
                // A file with the same name is already here
                $ecraser=$dbh ->query("SELECT * FROM linkuserstogroup WHERE idUser ='".$_SESSION['idUser']."' AND idGroupe='".$_SESSION['idGroupeUpload']."'")->fetch()['ecraser'];
                // Si j'ai le droit d'écraser
                if ($ecraser == "1"){
                    // Upload the file
                    move_uploaded_file($tempFile, $targetFile);

                    // Be sure that the file has been uploaded
                    if ( file_exists($targetFile) ) {
                        $dbh->query("UPDATE fichier SET proprietaire ='".$_SESSION['user']."', date = '".date("Y-m-d")."' WHERE nom='".$_FILES['file']['name']."' AND path ='".substr($_SESSION['uploadFolder'],11,-1)."'");

                        //Log
                        $content = date("H:i")." : ".$_SESSION['user']." -> "."uplaod du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" a ecrasé l'ancien fichier"."\n";
                        $log = fopen($path,"a+");
                        fputs($log,$content);
                        fclose($log);

                        $response = array (
                            'status'    => 'success',
                            'info'      => 'Le fichier a bien été remplacé',
                            'file_link' => $targetFile
                        );
                    } else {
                        //Log
                        $content = date("H:i")." : ".$_SESSION['user']." -> "."uplaod du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" échoué"."\n";
                        $log = fopen($path,"a+");
                        fputs($log,$content);
                        fclose($log);

                        $response = array (
                            'status' => 'error',
                            'info'   => 'Couldn\'t upload the requested file :(, a mysterious error happend.'
                        );
                    }
                } else{
                    //Log
                    $content = date("H:i")." : ".$_SESSION['user']." -> "."uplaod du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" échoué car l'utilisateur n'a pas l'autorisation d'écraser les fichiers"."\n";
                    $log = fopen($path,"a+");
                    fputs($log,$content);
                    fclose($log);

                    $response = array (

                        'status'    => 'error',
                        'info'      => 'Un fichier avec le meme nom existe deja. Vous ne pouvez pas le remplacer.',
                        'file_link' => $targetFile
                    );
                }

            }

        } else {
            //Log
            $content = date("H:i")." : ".$_SESSION['user']." -> "."uplaod du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" échoué car il n'est pas possible d'écrire dans ce dossier"."\n";
            $log = fopen($path,"a+");
            fputs($log,$content);
            fclose($log);

            $response = array (
                'status' => 'error',
                'info'   => 'The specified folder for upload isn\'t writeable.'
            );
        }
    } else {
        //Log
        $content = date("H:i")." : ".$_SESSION['user']." -> "."uplaod du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" échoué car le dossier est introuvable"."\n";
        $log = fopen($path,"a+");
        fputs($log,$content);
        fclose($log);

        $response = array (
            'status' => 'error',
            'info'   => 'No folder to upload to :(, Please create one.'
        );
    }

    // Return the response
    echo json_encode($response);
    exit;
}


// Remove file
if( $delete_file == 1 ){
    $file_path = $_POST['target_file'];

    // Check if file is exists
    if ( file_exists($file_path) ) {

        // Delete the file
        unlink($file_path);

        // Be sure we deleted the file
        if ( !file_exists($file_path) ) {
            //Log
            $content = date("H:i")." : ".$_SESSION['user']." -> "."suppresion du fichier \"".$_FILES['file']['name']."\" dans le dossier \"".substr($_SESSION['uploadFolder'],11)."\" reussi"."\n";
            $log = fopen($path,"a+");
            fputs($log,$content);
            fclose($log);

            $response = array (
                'status' => 'success',
                'info'   => 'Successfully Deleted.'
            );
        } else {
            // Check the directory's permissions
            $response = array (
                'status' => 'error',
                'info'   => 'We screwed up, the file can\'t be deleted.'
            );
        }
    } else {
        // Something weird happend and we lost the file
        $response = array (
            'status' => 'error',
            'info'   => 'Couldn\'t find the requested file :('
        );
    }

    // Return the response
    echo json_encode($response);
    exit;
}

?>