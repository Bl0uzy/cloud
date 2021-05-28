<?php
include "../bdd.php";

session_start();
if (!isset($_SESSION['idUser'])){
    header("Location: ../login.php");
} elseif ($_SESSION['user'] != "Admin"){
    header("Location: ../login.php");

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
		<h2 class="mb-4">Logs</h2>
        <div id="divLogsTableau">
            <table id="logsTableau" style="border-radius: 8px">
                <tr>
                    <td>
                        <label for="dateDebut">Du </label>
                        <input class="input" id="dateDebut" type="date">
                        <label for="dateFin"> au </label>
                        <input id="dateFin" type="date">
                        <button class="btn" id="dateFiltre">Valider</button>
                    </td>

                    <td>
                        <label for="dateSupp">Supprimer les logs avant le </label>
                        <input id="dateSupp" type="date">
                        <button class="btn" id="suppLogs">Supprimer</button>
                    </td>
                </tr>
            </table>







        </div>
        <div style="display: flex">
            <fieldset class="fieldsetLogs">
                <legend>Logs des connexions</legend>
                <div class="logs" id="logs">
                    <?php
                    $path = "../logs/connexion/";
                    foreach (scandir($path)as $fichier){
                        if (!($fichier == "." || $fichier == "..")){

                            echo "<strong>".date("d-m-Y",strtotime(substr($fichier,0,-4)))."</strong>"."<br>";
                            $file = file($path.$fichier);
                            foreach ($file as $ligne){
                                echo $ligne."<br>";
                            }
                        }
                    }
                    ?>
                </div>
            </fieldset>
            <fieldset class="fieldsetLogs">
                <legend>Logs des fichiers</legend>
                <div class="logs" id="logsFichier">
                    <?php
                    $path = "../logs/addFile/";
                    foreach (scandir($path)as $fichier){
                        if (!($fichier == "." || $fichier == "..")){

                            echo "<strong>".date("d-m-Y",strtotime(substr($fichier,0,-4)))."</strong>"."<br>";
                            $file = file($path.$fichier);
                            foreach ($file as $ligne){
                                echo $ligne."<br>";
                            }
                        }
                    }
                    ?>
                </div>
            </fieldset>

        </div>
	</div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/adminLogs.js"></script>

</body>
</html>