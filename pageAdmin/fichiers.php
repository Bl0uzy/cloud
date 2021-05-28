<?php
include "../bdd.php";
session_start();
if (!isset($_SESSION['idUser'])){
    header("Location: ../login.php");
} elseif ($_SESSION['user'] != "Admin"){
    header("Location: ../login.php");

}
header('Content-Description: File Transfer');

?>
<!doctype html>
<html lang="fr">
<head>
	<title>Fichiers</title>
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
		<h2 class="mb-4">Fichiers</h2>
        <table id="tableauDossierFichiers">
            <tr>
                <td>
                    <div id="dossiers"></div>

                </td>
                <td id="fichiers">
                    <table >
                        <tr id="topFichier">
                            <th style="padding-left: 20px" id="nomFichiers">Nom</th>
                            <th id="dateFichier">Ajouté le</th>
                            <th id="tailleFichier">Taille</th>
                            <th id="proprioFichier">Propriétaire</th>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/adminFichiers.js"></script>

</body>
</html>