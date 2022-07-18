<?php

require 'C:/xampp/htdocs/config.php';


$imprimante_marque = $_POST["imprimante_marque"];
$imprimante_modele = $_POST["imprimante_modele"];
$imprimante_serie = $_POST["imprimante_serie"];
$imprimante_artois = $_POST["imprimante_artois"];
$imprimante_mac = $_POST["imprimante_mac"];
$imprimante_IP = $_POST["imprimante_ip"];
$imprimante_reseau = $_POST["imprimante_reseau"];
$imprimante_profil = $_POST["imprimante_profil"];
$imprimante_partage = $_POST["imprimante_partage"];
$imprimante_batiment = $_POST["imprimante_batiment"];
$imprimante_etage = $_POST["imprimante_etage"];
$imprimante_salle = $_POST["imprimante_salle"];
$imprimante_commentaire = $_POST["imprimante_commentaire"];

if (empty($profil_impression)) {
    $profil_impression = null;
}

if(!empty($reseau))
    {
    $req = "INSERT INTO prise_reseau (num_prise_reseau) VALUES (:reseau)";
    $requete = $dbo->prepare($req);
    $requete->execute(array(':reseau' => $reseau));
    }
else{
}

if(!empty($IP))
    {
    $reqip = "INSERT INTO ip (ip_adresse, ip_adresse_mac) VALUES (:ip, :mac)";
    $requeteip = $dbo->prepare($reqip);
    $requeteip->execute(array(':ip' => $IP, ':mac' => $mac ));
    }
else{
}


if(!empty($imprimante_marque))
{
    $sql = "INSERT INTO imprimante
    (imprimante_marque,
    imprimante_modele,
    imprimante_num_serie,
    num_inventaire_artois,
    imprimante_adresse_mac,
    imprimante_adresse_ip,
    id_prise_reseau,
    id_imprimer,
    partage,
    id_bâtiment,
    id_etage,
    id_salle,
    commentaire)
    VALUES
    (:marque,
    :modele,
    :serie,
    :artois,
    :mac,
    :ip,
    :reseau,
    :imprimer,
    :partage,
    :batiment,
    :etage,
    :salle,
    :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':marque' => $imprimante_marque,
        ':modele' => $imprimante_modele, 
        ':serie' => $imprimante_serie,
        ':artois' => $imprimante_artois,
        ':mac' => $imprimante_mac,
        ':ip' => $imprimante_IP,
        ':reseau' => $imprimante_reseau,
        ':imprimer' => $imprimante_imprimer,
        ':partage' => $imprimante_partage,
        ':batiment' => $imprimante_batiment,
        ':etage' => $imprimante_etage,
        ':salle' => $imprimante_salle,
        ':commentaire' => $imprimante_commentaire,
    ));
}
$dbo = null;
?>
