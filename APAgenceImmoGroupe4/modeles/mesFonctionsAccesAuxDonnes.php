<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function connexionBDD()
{
$bdd = 'mysql:host=localhost;dbname=bdd_test';
$user ='root';
$password = 'root';
try {
   
    $ObjConnexion=new PDO($bdd,$user,$password,array(
           PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
 catch (PDOException $e)
 {
     echo $e->getMessage();
 }
return $ObjConnexion;
}

function donneLesBiens($pdo)
{
    $requete=$pdo->prepare("SELECT * FROM bien join typebien on bien.idtypebien = typebien.id order by ref");
    $execute=$requete->execute();
    $lesBiens=$requete->fetchAll();
    return $lesBiens;
}

function recupTailleMax($pdo,$table,$colonne){
    $requete=$pdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = :table AND COLUMN_NAME = :colonne");
    $bvc1=$requete->bindValue(':table',$table,PDO::PARAM_STR);
    $bvc2=$requete->bindValue(':colonne',$colonne,PDO::PARAM_STR);
    $execute=$requete->execute();
    $val=$requete->fetch();
    return $val;
}

function connexion($login,$mdp,$pdo){
    $req=$pdo->prepare("SELECT login,empreinte FROM utilisateur WHERE login=:login AND empreinte=:empreinte");
    $bvc=$req->bindValue(':login',$login);
    $bvc=$req->bindValue(':empreinte',sha1($mdp));
    $req->execute();
    $nbLigne=$req->rowCount();
    if($nbLigne!=0){
        $mailOk=true;
    }
    else{
        $mailOk=false;
    }
    return $mailOk;
}

function recupImages($id,$pdo){
    $requete=$pdo->prepare("SELECT chemin from images where idbien=:id");
    $bvc1=$requete->bindValue(':id',$id,PDO::PARAM_INT);
    $res=$requete->execute();
    $lesImages=$requete->fetchAll();
    return $lesImages;
}

function donneUnBien($id,$pdo)
{
    $requete=$pdo->prepare("SELECT * FROM bien join typebien on bien.idtypebien = typebien.id where ref=:id");
    $bvc1=$requete->bindValue(':id',$id,PDO::PARAM_INT);
    $execute=$requete->execute();
    $leBiens=$requete->fetch();
    return $leBiens;
}

function recherche($pdo,$type,$prix1,$prix2,$surfaceMin,$boolJardin,$nbPieces){
    
    //Tout
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2) AND surface>=:surface AND jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
   
    //Tout nul
    if($type==null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin==null && $nbPieces==null){
        $lesBiens= donneLesBiens($pdo);
    }
    
    //Juste type
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin==null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type");
        $bvc=$req->bindValue(':type',$type);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Juste prix
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin==null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE prix BETWEEN :prix1 AND :prix2");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Juste surface
    if($type==null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin==null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE surface>=:surface");
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Juste jardin
    if($type==null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE jardin=:jardin");
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Juste nbpieces
    if($type==null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE nb_piece=:nbpieces");
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Tout sauf type
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE (prix BETWEEN :prix1 AND :prix2) AND surface>=:surface AND jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Tout sauf prix
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND surface>=:surface AND jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Tout sauf surface
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2) AND jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Tout sauf jardin
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2) AND surface>=:surface AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //Tout sauf nbpieces
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2) AND surface>=:surface AND jardin=:jardin");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //surface, jardin, nbpieces,
    if($type==null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE surface>=:surface AND jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //prix, jardin, nbpieces
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE (prix BETWEEN :prix1 AND :prix2) AND jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //prix, surface, nbpieces
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE(prix BETWEEN :prix1 AND :prix2) AND surface>=:surface AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //prix, surface, jardin
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE (prix BETWEEN :prix1 AND :prix2) AND surface>=:surface AND jardin=:jardin");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, jardin, nbpieces
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, surface, nbpieces
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND surface>=:surface AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, surface, jardin
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND surface>=:surface AND jardin=:jardin");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, prix, nbpieces
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2) AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, prix, jardin
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2) AND jardin=:jardin");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, prix, surface
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin==null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2) AND surface>=:surface");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, prix
    if($type!=null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin==null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND (prix BETWEEN :prix1 AND :prix2)");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, surface
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin==null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND surface>=:surface");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, jardin
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND jardin=:jardin");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //type, nbpieces
    if($type!=null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE libelle=:type AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':type',$type);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //prix, surface
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin!=null && $boolJardin==null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE (prix BETWEEN :prix1 AND :prix2) AND surface>=:surface");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //prix, jardin
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE (prix BETWEEN :prix1 AND :prix2) AND jardin=:jardin");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //prix, nbpieces
    if($type==null && $prix1!=null && $prix2!=null && $surfaceMin==null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE (prix BETWEEN :prix1 AND :prix2) AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':prix1',$prix1);
        $bvc=$req->bindValue(':prix2',$prix2);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //surface, jardin
    if($type==null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin!=null && $nbPieces==null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE surface>=:surface AND jardin=:jardin");
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //surface, nbpieces
    if($type==null && $prix1==null && $prix2==null && $surfaceMin!=null && $boolJardin==null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE surface>=:surface AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':surface',$surfaceMin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    //jardin, nbpieces
    if($type==null && $prix1==null && $prix2==null && $surfaceMin==null && $boolJardin!=null && $nbPieces!=null){
        $req=$pdo->prepare("SELECT * FROM bien JOIN typebien ON typebien.id=bien.idtypebien WHERE jardin=:jardin AND nb_piece=:nbpieces");
        $bvc=$req->bindValue(':jardin',$boolJardin);
        $bvc=$req->bindValue(':nbpieces',$nbPieces);
        $execute=$req->execute();
        $lesBiens=$req->fetchAll();
    }
    
    return $lesBiens;
}

function ajouteBien($pdo,$ref,$idtypebien,$prix,$surface,$nbpieces,$rue,$ville,$cp,$description,$jardin){
    $requete=$pdo->prepare("Insert into bien (ref,idtypebien,prix,surface,nb_piece,rue,ville,cp,description,jardin) Values (:ref,:idtypebien,:prix,:surface,:nbpieces,:rue,:ville,:cp,:description,:jardin)");
    $bvc=$requete->bindValue(':ref',$ref,PDO::PARAM_INT);
    $bvc1=$requete->bindValue(':idtypebien',$idtypebien,PDO::PARAM_INT);
    $bvc2=$requete->bindValue(':prix',$prix);
    $bvc3=$requete->bindValue(':surface',$surface,PDO::PARAM_INT);
    $bvc4=$requete->bindValue(':nbpieces',$nbpieces,PDO::PARAM_INT);
    $bvc5=$requete->bindValue(':rue',$rue,PDO::PARAM_STR);
    $bvc6=$requete->bindValue(':ville',$ville,PDO::PARAM_STR);
    $bvc7=$requete->bindValue(':cp',$cp,PDO::PARAM_STR);
    $bvc8=$requete->bindValue(':description',$description,PDO::PARAM_STR);
    $bvc9=$requete->bindValue(':jardin',$jardin,PDO::PARAM_STR);
    $execute=$requete->execute();
    return $execute;
}

function recupMaxRefBien($pdo){
    $requete=$pdo->prepare("Select max(ref) from bien");
    $execute=$requete->execute();
    $max=$requete->fetch();
    return intval($max[0]);
}

function ajouteImageBien($pdo,$ref,$numImages){
    $requete=$pdo->prepare("Insert into images (primaire,idbien,chemin) Values (null,:ref,:chemin)");
    $bvc1=$requete->bindValue(':ref',$ref,PDO::PARAM_INT);
    if($numImages<10){
        $chemin=strval($ref).'0'.strval($numImages).'.jpg';
    }
    else{
        $chemin=strval($ref).strval($numImages).'.jpg';
    }
    $bvc2=$requete->bindValue(':chemin',$chemin,PDO::PARAM_STR);
    $execute=$requete->execute();
    return $execute;
}

function donneLesTypesBiens ($pdo){
    $requete=$pdo->prepare("Select libelle from typebien");
    $execute=$requete->execute();
    $typeBien=$requete->fetchAll();
    return $typeBien;
}

function supprimerBien($pdo,$id){
    $requete=$pdo->prepare("DELETE FROM images Where idbien=:id");
    $bvc=$requete->bindValue(':id',$id,PDO::PARAM_INT);
    $execute1=$requete->execute();
    $requete=$pdo->prepare("DELETE FROM bien Where ref=:id");
    $bvc=$requete->bindValue(':id',$id,PDO::PARAM_INT);
    $execute2=$requete->execute();
    return ($execute1 and $execute2);
}

function modifierBien($pdo,$ref,$idtypebien,$prix,$surface,$nbpieces,$rue,$ville,$cp,$description,$jardin){
    $requete=$pdo->prepare("Update bien Set idtypebien=:idtypebien, prix=:prix, surface=:surface, nb_piece=:nbpieces, rue=:rue, ville=:ville, cp=:cp, description=:description, jardin=:jardin Where ref=:ref");
    $bvc=$requete->bindValue(':ref',$ref,PDO::PARAM_INT);
    $bvc1=$requete->bindValue(':idtypebien',$idtypebien,PDO::PARAM_INT);
    $bvc2=$requete->bindValue(':prix',$prix);
    $bvc3=$requete->bindValue(':surface',$surface,PDO::PARAM_INT);
    $bvc4=$requete->bindValue(':nbpieces',$nbpieces,PDO::PARAM_INT);
    $bvc5=$requete->bindValue(':rue',$rue,PDO::PARAM_STR);
    $bvc6=$requete->bindValue(':ville',$ville,PDO::PARAM_STR);
    $bvc7=$requete->bindValue(':cp',$cp,PDO::PARAM_STR);
    $bvc8=$requete->bindValue(':description',$description,PDO::PARAM_STR);
    $bvc9=$requete->bindValue(':jardin',$jardin,PDO::PARAM_STR);
    $execute=$requete->execute();
    return $execute;
}

function modifierMdp($login, $pdo, $question, $reponse, $mdp1, $mdp2){
    $req=$pdo->prepare("SELECT id_question, reponse FROM utilisateur WHERE id_question=:idquestion AND reponse=:reponse AND login=:login");
    $bvc=$req->bindValue(':idquestion',$question);
    $bvc=$req->bindValue(':reponse',sha1($reponse));
    $req->execute();
    $nbLigne=$req->rowCount();
    if($nbLigne!=0 && $mdp1=$mdp2){
        $req2=$pdo->prepare("UPDATE utilisateur SET empreinte=:empreinte WHERE login=:login");
        $bvc2=$req->bindValue(':empreinte',sha1($mdp1));
        $bvc2=$req->bindValue(':login',$login);
        $req2->execute();
        $ok=true;
    }
    else{
        $ok=false;
    }
    return $ok;
}
