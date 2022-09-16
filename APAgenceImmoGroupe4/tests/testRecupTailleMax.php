<?php
include_once '../modeles/mesFonctionsAccesAuxDonnes.php';

//appel de la fonction qui permet de se connecter à la base de données
$lePdo = connexionBDD();

var_dump(recupTailleMax($lePdo,'bien','surface'));
