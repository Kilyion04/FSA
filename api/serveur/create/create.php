<?php

require 'C:/xampp/htdocs/config.php';

$serveur_marque = $_POST['serveur_marque'];
$serveur_modele = $_POST['serveur_modele'];
$serveur_serie = $_POST['serveur_serie'];
$serveur_artois = $_POST['serveur_artois'];
$serveur_mac = $_POST['serveur_mac'];
$serveur_IP = $_POST['serveur_ip'];
$serveur_reseau = $_POST['serveur_reseau'];
$serveur_systeme = $_POST['serveur_systeme'];
$serveur_RAM = $_POST['serveur_RAM'];
$serveur_un = $_POST['serveur_un'];
$serveur_deux = $_POST['serveur_deux'];
$serveur_batiment = $_POST['serveur_batiment'];
$serveur_etage = $_POST['serveur_etage'];
$serveur_salle = $_POST['serveur_salle'];
$serveur_commentaire = $_POST['serveur_commentaire'];



if(!empty($serveur_reseau))
    {
    $req = "INSERT INTO prise_reseau (num_prise_reseau) VALUES (:reseau)";
    $requete = $dbo->prepare($req);
    $requete->execute(array(':reseau' => $serveur_reseau));
    }
else{
}

if(!empty($serveur_IP))
    {
    $reqip = "INSERT INTO ip (ip_adresse, ip_adresse_mac) VALUES (:ip, :mac)";
    $requeteip = $dbo->prepare($reqip);
    $requeteip->execute(array(':ip' => $serveur_IP, ':mac' => $serveur_mac ));
    }
else{
}

if(!empty($serveur_marque))
{
    $sql = "INSERT INTO serveur (serveur_marque,
    serveur_modele,
    serveur_num_serie,
    serveur_num_inventaire_artois,
    serveur_adresse_mac,
    serveur_adresse_ip,
    serveur_prise_reseau,
    serveur_systeme_exploitation,
    serveur_memoire_RAM,
    serveur_taille_disque_1,
    serveur_taille_disque_2,
    id_bâtiment,
    id_etage,
    id_salle,
    commentaire) 
    VALUES (:marque,
    :modele,
    :serie,
    :artois,
    :mac,
    :IP,
    :reseau,
    :systeme,
    :RAM,
    :un,
    :deux,
    :batiment,
    :etage,
    :salle,
    :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':marque' => $serveur_marque,
        ':modele' => $serveur_modele, 
        ':serie' => $serveur_serie ,
        ':artois' => $serveur_artois ,
        ':mac' => $serveur_mac,
        ':IP' => $serveur_IP,
        ':reseau' => $serveur_reseau,
        ':systeme' => $serveur_systeme ,
        ':RAM' => $serveur_RAM ,
        ':batiment' => $serveur_batiment ,
        ':etage' => $serveur_etage ,
        ':salle' => $serveur_salle ,
        ':un' => $serveur_un ,
        ':deux' => $serveur_deux ,
        ':commentaire' => $serveur_commentaire
    ));
}

$dbo = null;
?>