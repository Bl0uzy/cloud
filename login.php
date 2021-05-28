<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="./css/loginStyle.css">
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" action="connexion.php" method="post">
            <input type="text" name="user" placeholder="username"/>
            <input type="password" name="passw" placeholder="password"/>
            <button>login</button>
            <?php
            if (isset($_GET['error'])){
                if ($_GET['error']=="pswOrId"){
                    echo "Mot de passe ou identifiant incorrect";
                }
                if ($_GET['error']=="notFull"){
                    echo "Veuillez saisir tous les champs";
                }
            }
            ?>
        </form>
    </div>
</div>
</body>
</html>