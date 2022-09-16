<?php
session_start();
?>
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
            include_once '../inc/nav_employe.inc';
         ?>
        <ul id="menuEmploye">
            <li><a href="" title="Accueil">Ajouter un bien </a></li>
            <br><br>
            <li><a href="id.php" title="Contact"> Modifier un bien </a></li>
            <br><br>
            <li><a href="../modeles/deconnexion.php" title="Deconnexion">Déconnexion</a></li>
        </ul> 
        
        <?php
         include_once '../inc/footer.inc';
        ?>
    </body>
</html>
