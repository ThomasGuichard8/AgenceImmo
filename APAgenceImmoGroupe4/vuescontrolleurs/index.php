<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agence Immobilière</title>
        <link href="../css/CharteGraphique.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include_once '../inc/header.inc';
        if((isset($_SESSION['login']))){
                include_once '../inc/nav_employe.inc';
            }
        else{
            include_once '../inc/nav.inc';
        }
        ?>
        <br><br><br>
        <br>
        <div id="patrons">Par Cyril Florent, Thomas Guichard et Ryan Dehli</div>
        <br><br>
        <div id="exemple">Un exemple de ce que nous vendons :</div>
        <br><br>
        <img id="ImageBien" src="../img/exempleMaison.jpg" alt="" height="500" width="900">
        <div id="Description">
            Type : Maison<br><br>
            Prix : 200 000 €<br><br>
            Surface : 400 m²<br><br>
            Nombre pièce : 9 pièces<br><br>
            Adresse : 21 rue du Boulanger, Tourcoing, 59200<br><br>
        </div>        
        <?php
        include_once '../inc/footer.inc';
        ?>
    </body>
</html>
