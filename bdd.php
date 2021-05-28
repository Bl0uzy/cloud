<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=dropfile', "root", "");
//    foreach($dbh->query('SELECT * from FOO') as $row) {
//        print_r($row);
//    }
//    $dbh = null;
//    echo "connexion reussi";
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
