<?php
include_once '../modeles/mesFonctionsAccesAuxDonnes.php';

$pdo = connexionBDD();

var_dump(recupImages(1,$pdo));

