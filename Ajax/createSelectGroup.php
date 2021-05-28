<?php
include "../bdd.php";
echo "<select id='' class='newGroup'>";
echo "<option value=\"\"></option>";
foreach ($dbh ->query("SELECT * FROM groupe")as $row){  //Pour remplir le select avec tous les groupes existant
    echo "<option ";
    echo " value=\"".$row['id']."\">".$row['nom']."</option>";
}
echo "</select>";