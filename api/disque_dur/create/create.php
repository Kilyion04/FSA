<?php

require 'C:/xampp/htdocs/config.php';


$disque_marque = $_POST["disque_marque"];
$disque_modele = $_POST["disque_modele"];
$disque_taille = $_POST["disque_taille"];
$disque_mac = $_POST["disque_mac"];
$disque_IP = $_POST["disque_ip"];
$disque_reseau = $_POST["disque_reseau"];
$disque_commentaire = $_POST["disque_commentaire"];

if(!empty($disque_reseau))
    {
    $req = "INSERT INTO prise_reseau (num_prise_reseau) VALUES (:reseau)";
    $requete = $dbo->prepare($req);
    $requete->execute(array(':reseau' => $disque_reseau));
    }
else{
}

if(!empty($disque_IP))
    {
    $reqip = "INSERT INTO ip (ip_adresse, ip_adresse_mac) VALUES (:ip, :mac)";
    $requeteip = $dbo->prepare($reqip);
    $requeteip->execute(array(':ip' => $disque_IP, ':mac' => $disque_mac ));
    }
else{
}

if(!empty($disque_marque))
{
    $sql = "INSERT INTO disque_dur (disque_marque,
    disque_modele,
    disque_taille,
    disque_adresse_mac,
    ip_adresse,
    num_prise_reseau,
    commentaire) 
    VALUES (:marque, :modele, :taille, :mac, :IP, :reseau, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':marque' => $disque_marque,
        ':modele' => $disque_modele, 
        ':taille' => $disque_taille,
        ':mac' => $disque_mac,
        ':IP' => $disque_IP,
        ':reseau' => $disque_reseau,
        ':commentaire' => $disque_commentaire
    ));
}
$dbo = null;
?>