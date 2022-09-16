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
        
        <form name="modifier" id="modifier" method="post" action="modifierBien.php">
            
            <div>Entrez l'id du bien à modifier : </div>
            <input type="text" name="id" id="id">
            <input type="submit" name="valider" id="valider" value="Valider"/>
            
        </form>
        
        <?php
            include_once '../inc/footer.inc';
        ?>
        
    </body>
</html>
