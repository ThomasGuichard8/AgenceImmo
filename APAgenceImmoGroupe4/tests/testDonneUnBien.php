<?php

include_once '../modeles/mesFonctionsAccesAuxDonnes.php';

$lePdo = connexionBDD();

var_dump(donneUnBien(1,$lePdo));
