<?php
include "../bdd.php";

session_start();
if (!isset($_SESSION['idUser'])){
    header("Location: ../login.php");
} elseif ($_SESSION['user'] != "Admin"){
    header("Location: ../login.php");
}
if (isset($_POST['userName']) && isset($_POST['passw'])){
    $dbh ->query("INSERT INTO users(nom,passw) VALUES (\"".$_POST['userName']."\",\"".$_POST['passw']."\")");
//    echo "L'utilisateur ".$_POST['userName']." a été ajouter";
    if ($_POST["groupe"] != ""){
        $idUser = $dbh ->query("SELECT * FROM users WHERE nom=\"".$_POST['userName']."\"")->fetch()['id'];
        $dbh->query("INSERT INTO linkuserstogroup(idUser,idGroupe) VALUES (\"".$idUser."\",\"".$_POST["groupe"]."\")");
    }
    header("Location: users.php?user=".$_POST['userName']);
}
?>
<!doctype html>
<html lang="fr">
<head>
    <title>Utilisateurs</title>
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
        <h2 class="mb-4">Utilisateurs</h2>
        <table id="usersTable">
            <tr>
                <th>Nom de l'utilisateur</th>
                <th>Mot de passe</th>
                <th>Groupe</th>
            </tr>
            <tr>
                <?php
                foreach ($dbh->query("SELECT * FROM users")as $users){ //Pour chaque utilisateur
                    echo "<tr id='".$users['id']."'>";
                    echo "<td>".$users['nom'];
                    if ($users['nom'] != "admin"){
                        echo "<img src=\"../icons/user.png\" class='iconBtn delUser' alt=\"Supprimer\" title=\"Supprimer\"></td>";
                    }

                    echo "<td><input type='password' size='5em' value='".$users['passw']."' ><img class='iconBtn voirMdp' src=\"../icons/eye.png\" alt=\"Voir\" title=\"Voir\"> <img class='iconBtn modifMdp' src=\"../icons/edit-button.png\" alt=\"edit\" title=\"Modifier\" ></td>";

                    echo "<td>";
                    foreach ($dbh->query("SELECT * FROM linkuserstogroup WHERE idUser=\"".$users['id']."\"") as $group){ //Pour chaque groupe lié a l'utilisateur
                        echo "<select id='".$group['id']."' class='group'>";
                        echo "<option value=\"\"></option>";
                        foreach ($dbh ->query("SELECT * FROM groupe")as $row){  //Pour remplir le select avec tous les groupes existant
                            echo "<option ";
                            if ($group['idGroupe'] == $row['id']){
                                echo 'selected="selected"';
                            }
                            echo " value=\"".$row['id']."\">".$row['nom']."</option>";
                        }
                        echo "</select>";
                    }
                if ($users['nom'] != "admin") {
                    echo "<img class='iconBtn addGroupe' src=\"../icons/add-button.png\" alt=\"Ajouter\" title=\"Ajouter un groupe\">";
                }
                    echo "</td></tr>";
                }
                ?>
            </tr>
        </table>
        <br>

        <!--       Création d'un user-->
        <form action="" method="post">
            <fieldset id="fieldsetNewUser">
                <legend>Ajouter un utisateur</legend>
                <label for="userName">Nom : </label>
                <input type="text" id="userName" name="userName" placeholder="Nom de l'utilisateur">
                <label for="passw">Mot de passe :</label>
                <input type="text" name="passw" id="passw" placeholder="Mot de passe">
                <label for="choixGroupe">Groupe :</label>
                <select name="groupe" id="choixGroupe">
                    <option value=""></option>
                    <?php
                    foreach ($dbh ->query("SELECT * FROM groupe")as $row){
                        echo "<option value=\"".$row['id']."\">".$row['nom']."</option>";
                    }
                    ?>
                </select>
                <button class="btn btn-primary btn-sm" style="margin-left:4% ">Ajouter</button>
            </fieldset>
        </form>
        <?php
        if (isset($_GET['user'])){
            echo "L'utilisateur ".$_GET['user']." a bien été ajouté";
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/adminUser.js"></script>

</body>
</html>