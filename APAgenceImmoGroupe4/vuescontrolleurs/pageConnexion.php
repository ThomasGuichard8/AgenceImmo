<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agence Immobilière</title>
        <link href="../css/CharteGraphique.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
            include_once '../inc/header.inc';
            include_once '../inc/nav.inc';
            ?>
        
        <form name="connexion" id="connexion" method="post" action="../modeles/validation.php">
            <br><br>
            <label for="email" title="Veuillez saisir votre e-mail" class="oblig">Login : </label>
            <input type="text" name="login" id="login" required/>
            <br><br>
            <label for="mdp" title="Veuillez saisir votre mot de passe" class="oblig">Mot de passe : </label>
            <input type="password" name="mdp" id="mdp" required/>
            <br><br>
            <input type="submit" name="valider" id="valider" value="Connexion"/>
        </form>
        
        <form name="mdpOublie" id="mdpOublie" method="post" action="mdpOublie.php">
            <input type="submit" name="validerMdp" id="validerMdp" value="Mot de passe oublié"/>
        </form>
        
        <?php
            include_once '../inc/footer.inc';
            ?>
    </body>
</html>
