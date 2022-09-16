<?php
include_once 'mesFonctionsAccesAuxDonnes.php';
include_once '../vuescontrolleurs/ajoutBien.php';
$controle=true;
$pdo= connexionBDD();
$ref= recupMaxRefBien($pdo)+1;
$typebien=intval(trim(htmlspecialchars($_POST['typebien'])));
$prix=trim(htmlspecialchars($_POST['prix']));

//controle de saisit du prix
if(is_numeric($prix)==false){
    $controle=false;
    echo 'ERREUR !<br>';
    echo 'Le prix doit être une valeur numérique<br>Vous serez redirigé vers le menu employe dans 5 secondes';
    header( "refresh:5;url=http://localhost/APAgenceImmoGroupe4/vuescontrolleurs/menu.php");
}
else{
    $prix= doubleval($prix);
}

//controle saisit surface
$surface=trim(htmlspecialchars($_POST['surface']));
if($controle and is_numeric($surface)==false){
    $controle=false;
    echo 'ERREUR !<br>';
    echo 'La surface doit être un entier<br>Vous serez redirigé vers le menu employe dans 5 secondes';
    header( "refresh:5;url=http://localhost/APAgenceImmoGroupe4/vuescontrolleurs/menu.php");
}
else{
    $surface= intval($surface);
}

$nb_piece=trim(htmlspecialchars($_POST['nb_piece']));

//controle saisit du nombre de piece
if($controle and is_numeric($nb_piece)==false){
    $controle=false;
    echo 'ERREUR !<br>';
    echo 'Le nombre de pièces doit être un entier<br>Vous serez redirigé vers le menu employe dans 5 secondes';
    header( "refresh:5;url=http://localhost/APAgenceImmoGroupe4/vuescontrolleurs/menu.php");
}
else{
    $nb_piece= intval($nb_piece);
}

$rue=htmlspecialchars($_POST['rue']);
$ville=htmlspecialchars($_POST['ville']);
$cp=trim(htmlspecialchars($_POST['cp']));
$description=htmlspecialchars($_POST['description']);
$jardin=trim(htmlspecialchars($_POST['jardin']));
$nbPhoto=trim(htmlspecialchars($_POST['photo']));

//controle saisit du nombre photo
if($controle and is_numeric($nbPhoto)==false){
    $controle=false;
    echo 'ERREUR !<br>';
    echo 'Le nombre de photo doit être un entier<br>Vous serez redirigé vers le menu employe dans 5 secondes';
    header( "refresh:5;url=http://localhost/APAgenceImmoGroupe4/vuescontrolleurs/menu.php");
}
else{
    $nbPhoto= intval($nbPhoto);
}

//ajoute bien et image
if($controle){
    if(ajouteBien($pdo,$ref,$typebien,$prix,$surface,$nb_piece,$rue,$ville,$cp,$description,$jardin)==true){
        echo 'Le bien a été ajouté avec succés<br>';
    }
    else{
        header('Location: http://localhost/APAgenceImmoGroupe4/vuescontrolleurs/index.php');
        exit();
    }
    if($nbPhoto>0){
        for($i=1;$i<=$nbPhoto;$i++){
            if(ajouteImageBien($pdo, $ref, $i)==true){
                echo 'L\'image '.$i.' a été ajouté avec succés<br>';
            }
            else{
                echo 'L\'image '.$i.' n\'a pas été ajouté<br>';
            }
        }
    }
    echo 'Vous serez redirigé vers le nouveau bien dans 5 secondes';
    header( "refresh:5;url=http://localhost/APAgenceImmoGroupe4/vuescontrolleurs/Biens.php?id=".$ref);
}
