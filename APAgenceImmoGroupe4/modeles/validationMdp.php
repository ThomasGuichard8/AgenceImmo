<?php

include_once 'mesFonctionsAccesAuxDonnes.php';
include_once '../vuescontrolleurs/mdpOublie.php';

$login= htmlspecialchars($_POST['log']);
$question=htmlspecialchars($_POST['question']);
$reponse= htmlspecialchars($_POST['reponse']);
$mdp1= htmlspecialchars($_POST['mdp1']);
$mdp2= htmlspecialchars($_POST['mdp2']);
$pdo= connexionBDD();

if(modifierMdp($login, $pdo, $question, $reponse, $mdp1, $mdp2)==true){
    session_start();
    $_SESSION['login']=$login;
    echo 'Modification effectuée avec succès';
}
else{
    echo 'Erreur, soit la question secrète n\'est pas la bonne, soit la réponse n\'est pas correcte, soit les mots de passes ne correspondent pas';
}
