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
        
        <form name="recherche" id="recherche" method="post" action="voirLesRecherches.php">
            
            <div name="criteres" id="criteres">Rechercher par : </div>
            <select name="type" id="type">
                <option value="">---</option>
                <option value="maison">Maison</option>
                <option value="appartement">Appartement</option>
                <option value="immeuble">Immeuble</option>
                <option value="local">Local</option>
                <option value="terrain">Terrain</option>
            </select>
            
            <div id="prix" name"prix">Entre
                <input type="text" id="prix1" name="prix1"/>
                et
                <input type="text" id="prix2" name="prix2"/>
                <input type="submit" name="valider" id="valider" value="Valider"/>
            </div>
            
            <div id="divSurface" name="divSurface">Surface minimum : </div>
            <input type="text" id="surfaceMin" name="surfaceMin"/>
            
            <div name="jardin" id="jardin">Présence d'un jardin : </div>
            <select name="boolJardin" id="boolJardin">
                <option value="">---</option>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
            
            <div id="Pieces" name="Pieces">Nombres de pièces : </div>
            <input type="text" id="nbPieces" name="nbPieces"/>
            
        </form>
        
        <?php
            include_once '../inc/footer.inc';
        ?>
        
    </body>
</html>
