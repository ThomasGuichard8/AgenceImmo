<?php
include_once '../modeles/mesFonctionsAccesAuxDonnes.php';

$pdo = connexionBDD();
$ref = recupMaxRefBien($pdo)+1;
var_dump(ajouteBien($pdo,$ref,1,100000.0,"150",5,"rue du test","Lille","59000","description","non"));
