<?php

require 'C:/xampp/htdocs/config.php';


$station_marque = $_POST["station_marque"];
$station_modele = $_POST["station_modele"];
$station_num_serie = $_POST["station_num_serie"];
$station_mac = $_POST["station_mac"];
$station_commentaire = $_POST["station_commentaire"];

if(!empty($mac))
    {
    $req = "INSERT INTO ip (ip_adresse_mac) VALUES (:mac)";
    $requete = $dbo->prepare($req);
    $requete->execute(array(':mac' => $mac));
    }
else{
}

if(!empty($station_marque))
{
    $sql = "INSERT INTO station_accueil (station_marque, station_modele, station_num_serie, 
    station_adresse_mac, commentaire) 
    VALUES (:marque, :modele, :serie, :mac, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':marque' => $station_marque,
        ':modele' => $station_modele,
        ':serie' => $station_num_serie,
        ':mac' => $station_mac,
        ':commentaire' => $station_commentaire,
    ));
}
$dbo = null;
?>