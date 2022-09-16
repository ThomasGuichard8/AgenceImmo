<?php
include_once 'mesFonctionsAccesAuxDonnes.php';
include_once '../vuescontrolleurs/modifierBien.php';

$controle=true;
$pdo= connexionBDD();
$ref=trim(htmlspecialchars($_GET['id']));
$typebien=intval(trim(htmlspecialchars($_POST['typebien'])));
$prix=trim(htmlspecialchars($_POST['prix']));

//controle de saisit du prix
if(is_numeric($prix)==false){
    $controle=false;
    echo 'ERREUR !<br>';
}
else{
    $prix= doubleval($prix);
}

//controle saisit surface
$surface=trim(htmlspecialchars($_POST['surface']));
if($controle and is_numeric($surface)==false){
    $controle=false;
    echo 'ERREUR !<br>';
}
else{
    $surface= intval($surface);
}

$nb_piece=trim(htmlspecialchars($_POST['nb_piece']));

//controle saisit du nombre de piece
if($controle and is_numeric($nb_piece)==false){
    $controle=false;
    echo 'ERREUR !<br>';
}
else{
    $nb_piece= intval($nb_piece);
}

$rue=htmlspecialchars($_POST['rue']);
$ville=htmlspecialchars($_POST['ville']);
$cp=trim(htmlspecialchars($_POST['cp']));
$description=htmlspecialchars($_POST['description']);
$jardin=trim(htmlspecialchars($_POST['jardin']));

//ajoute bien et image
if($controle){
    if(modifierBien($pdo,$ref,$typebien,$prix,$surface,$nb_piece,$rue,$ville,$cp,$description,$jardin)==true){
        echo 'Le bien a été modifié avec succés<br>';
    }
    else{
        echo 'ERREUR';
        exit();
    }
}
