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
        
        <form name="nvMdp" id="nvMdp" method="post" action="../modeles/validationMdp.php">
            
            <div>Entrez votre login : </div>
            <input type="text" id="log" name="log" required>
            
            <div>Sélectionnez votre question secrète :</div>
            <select name="question" id="question" required>
                <option value="1">Quel est le nom de votre premier animal de compagnie ?</option>
                <option value="2">Quelle est la marque de votre première voiture ?</option>
                <option value="3">Quel est le nom de votre plat préféré ?</option>
                <option value="4">Quelle est votre couleur préférée ?</option>
            </select>
            
            <br><br>
            
            <div>Entrez votre réponse : </div>
            <input id="reponse" name="reponse" type="text" required>
            
            <div>Entrez votre nouveau mot de passe : </div>
            <input type="password" id="mdp1" name="mdp1" required>
            
            <div>Entrez le à nouveau : </div>
            <input type="password" id="mdp2" name="mdp2" required>
            
            <input type="submit" id="valider" name="valider">
            
        </form>
        
        <?php
            include_once '../inc/footer.inc';
            ?>
    </body>
</html>
