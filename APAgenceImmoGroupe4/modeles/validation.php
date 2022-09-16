<?php

include_once 'mesFonctionsAccesAuxDonnes.php';
include_once '../vuescontrolleurs/pageConnexion.php';

$login=trim(htmlspecialchars($_POST['login']));
$mdp= htmlspecialchars($_POST['mdp']);
$pdo= connexionBDD();

if(connexion($login, $mdp, $pdo)==true){
    session_start();
    $_SESSION['login']=$login;
    echo '<script language="JavaScript">
             setTimeout("window.location=\''."../vuescontrolleurs/menu.php".'\'"); 
             </script>';
}
else{
    echo 'Connexion impossible';
}
