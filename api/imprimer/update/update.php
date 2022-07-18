<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['imprimante'])){
    $id = $_POST['imprimante'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $serie = $_POST['serie'];
    $artois = $_POST['artois'];
    $mac = $_POST['mac'];
    $ip = $_POST['ip'];
    $reseau = $_POST['reseau'];
    $imprimer = $_POST['imprimer'];
    $partage = $_POST['partage'];
    $id_batiment = $_POST['batiment'];
    $id_etage = $_POST['etage'];
    $id_salle = $_POST['salle'];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE imprimante 
    SET imprimante_marque = :marque,
    imprimante_modele = :modele,
    imprimante_num_serie = :serie,
    num_inventaire_artois = :artois,
    imprimante_adresse_mac = :mac,
    imprimante_adresse_ip = :ip,
    id_prise_reseau = :reseau,
    id_imprimer = :imprimer,
    partage = :partage,
    id_bâtiment = :id_batiment,
    id_etage = :id_etage,
    id_salle = :id_salle,
    commentaire = :commentaire 
    WHERE id_imprimante = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":marque" => $marque ,
        ":modele" => $modele ,
        ":serie" => $serie ,
        ":artois" => $artois ,
        ":mac" => $mac ,
        ":ip" => $ip ,
        ":reseau" => $reseau ,
        ":imprimer" => $imprimer ,
        ":partage" => $partage ,
        ":id_batiment" => $id_batiment ,
        ":id_etage" => $id_etage ,
        ":id_salle" => $id_salle ,
        ":commentaire" => $commentaire
    ));
    echo $_POST['imprimante'];
}
else{
    echo "erreur";
}


header("location: /wordpress/imprimante/");


?>