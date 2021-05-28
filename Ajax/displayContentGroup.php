<?php
include "../bdd.php";
$nomGroupe = $_GET['nom'];
$nomGroupe = substr($nomGroupe,1,strlen($nomGroupe)-1);
$idGroupe = $dbh->query("SELECT * FROM groupe WHERE nom = \"". $nomGroupe."\"")->fetch()['id'];
$docs = $dbh->query("SELECT * FROM groupe WHERE nom = '$nomGroupe'")->fetch()['docs'];
echo "

<form method='post'>
<label for='lienDoc'>Copier le lien du Google Doc ici :</label>
<input id='lienDoc' name='lienDoc' type='text' value='$docs'>
<input hidden name='idGroupe' value='".$idGroupe."'>
<button class='btn'>Valider</button>
</form>";
