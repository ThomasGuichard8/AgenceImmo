<?php
include_once '../modeles/mesFonctionsAccesAuxDonnes.php';

$pdo = connexionBDD();

var_dump(supprimerBien($pdo,15));