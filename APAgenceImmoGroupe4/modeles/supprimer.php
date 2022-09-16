<?php
include_once 'mesFonctionsAccesAuxDonnes.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $pdo= connexionBDD();
    $fonctionne=supprimerBien($pdo,$id);
    if($fonctionne==true){
        header("refresh:5;url=../vuescontrolleurs/index.php");
        echo 'Le bien et ses images on été supprimé<br>Vous serez redirigé vers l\'accueil dans 5 sec';
    }
    else{
        header("refresh:5;url=http://localhost/APAgenceImmoGroupe4/vuescontrolleurs/voirLesBiens.php");
        echo 'Erreur<br>Vous serez redirigé vers la liste des biens dans 5 sec';
    }
}
