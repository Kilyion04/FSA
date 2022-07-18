<?php
session_start();
require 'C:/xampp/htdocs/config.php';

$appareil_marque = $_POST["appareil_marque"];
$appareil_type = $_POST["appareil_type"];
$appareil_modele = $_POST["appareil_modele"];
$appareil_modele = $_POST["appareil_modele"];
$appareil_ip = $_POST["appareil_ip"];
$appareil_reseau = $_POST["appareil_reseau"];
$appareil_batiment = $_POST["appareil_batiment"];
$appareil_etage = $_POST["appareil_etage"];
$appareil_salle = $_POST["appareil_salle"];
$appareil_commentaire = $_POST["appareil_commentaire"];


if(!empty($appareil_reseau))
    {
    $req = "INSERT INTO prise_reseau (num_prise_reseau) VALUES (:reseau)";
    $requete = $dbo->prepare($req);
    $requete->execute(array(':reseau' => $appareil_reseau));
    }
else{
}

if(!empty($appareil_ip))
    {
    $reqip = "INSERT INTO ip (ip_adresse, ip_adresse_mac) VALUES (:ip, :mac)";
    $requeteip = $dbo->prepare($reqip);
    $requeteip->execute(array(':ip' => $appareil_ip, ':mac' => $appareil_modele ));
    }
else{
}

if(!empty($appareil_marque))
{
    $sql = "INSERT INTO appareil_mesure (appareil_marque, appareil_type, appareil_modele, appareil_adresse_mac, appareil_adresse_ip, prise_reseau, bâtiment, etage, salle, commentaire) 
    VALUES (:marque, :types, :modele, :mac, :ip, :reseau, :batiment, :etage, :salle, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':marque' => $appareil_marque,
        ':types' => $appareil_type, 
        ':modele' => $appareil_modele,
        ':mac' => $appareil_modele,
        ':ip' => $appareil_ip,
        ':reseau' => $appareil_reseau,
        ':batiment' => $appareil_batiment,
        ':etage' => $appareil_etage,
        ':salle' => $appareil_salle,
        ':commentaire' => $appareil_commentaire
    ));
}

$dbo = null;
?>