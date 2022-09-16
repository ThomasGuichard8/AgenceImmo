<?php
include_once '../modeles/mesFonctionsAccesAuxDonnes.php';

$pdo = connexionBDD();

var_dump(ajouteImageBien($pdo, 14, 5));

var_dump(ajouteImageBien($pdo, 14, 11));

