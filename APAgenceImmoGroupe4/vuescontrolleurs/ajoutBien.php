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
        <title>Ajout bien</title>
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
        
        <form name="ajoutBien" id="ajoutBien" method="post" action="../modeles/traitementAjoutBien.php">
            <br><br>
            Type:   
            <select name="typebien">
                <?php
                include_once '../modeles/mesFonctionsAccesAuxDonnes.php';
                $pdo= connexionBDD();
                $typeBiens= donneLesTypesBiens($pdo);
                $compteur=1;
                foreach($typeBiens as $type){
                    echo '<option value="'.$compteur.'">'.$type['libelle'].'</option><br>';
                    $compteur++;
                }
                ?>
            </select>
            <br><br>
            Prix:   <input required type="text" id="prix" name="prix"/><br><br>
            Surface:   <input maxlength="10" required type="text" id="surface" name="surface"/><br><br>
            Nombre pièce:   <input required type="text" id="nb_piece" name="nb_piece"/><br><br>
            Rue:   <input maxlength="50" required type="text" id="rue" name="rue"/><br><br>
            Ville:   <input maxlength="30" required type="text" id="ville" name="ville"/><br><br>
            Code postal:   <input maxlength="5" required type="text" id="cp" name="cp"/><br><br>
            Description (optionelle):   <input maxlength="100" type="text" id="description" name="description"/><br><br>
            Jardin:   
            <select name="jardin">
                <option value="non">Non</option>
                <option value="oui">Oui</option>
            </select><br><br>
            Nombre photo(s):   <input maxlength="3" type="text" id="photo" name="photo"/>
            <input type="submit" name="valider" id="valider" value="Valider"/>
        </form>
        
        <?php
            echo '<br><br><br><br><br><br><br><br><br><br><br><br>';
            include_once '../inc/footer.inc';
        ?>
        
    </body>
</html>
