<?php
include_once '../modeles/mesFonctionsAccesAuxDonnes.php';

$lePdo = connexionBDD();

var_dump(donneLesBiens($lePdo));
