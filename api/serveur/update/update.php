<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['serveur'])){
    $id = $_POST['serveur'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $serie = $_POST['serie'];
    $artois = $_POST['artois'];
    $MAC = $_POST['MAC'];
    $IP = $_POST['IP'];
    $reseau = $_POST['reseau'];
    $systeme = $_POST['systeme'];
    $RAM = $_POST['RAM'];
    $un = $_POST['un'];
    $deux = $_POST['deux'];
    $batiment = $_POST['batiment'];
    $etage = $_POST['etage'];
    $salle = $_POST['salle'];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE serveur SET serveur_marque = :marque,
    serveur_modele = :modele,
    serveur_num_serie = :serie,
    serveur_num_inventaire_artois = :artois,
    serveur_adresse_mac = :MAC,
    serveur_adresse_ip = :IP,
    serveur_prise_reseau = :reseau,
    serveur_systeme_exploitation = :systeme,
    serveur_memoire_RAM = :RAM,
    id_bâtiment = :batiment,
    id_etage = :etage,
    id_salle = :salle,
    serveur_taille_disque_1 = :un,
    serveur_taille_disque_2 = :deux,
    commentaire = :commentaire
    WHERE id_serveur = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ':id' => $id,
        ':marque' => $marque,
        ':modele' => $modele, 
        ':serie' => $serie ,
        ':artois' => $artois ,
        ':MAC' => $MAC,
        ':IP' => $IP,
        ':reseau' => $reseau,
        ':systeme' => $systeme ,
        ':RAM' => $RAM ,
        ':batiment' => $batiment ,
        ':etage' => $etage ,
        ':salle' => $salle ,
        ':un' => $un ,
        ':deux' => $deux ,
        ':commentaire' => $commentaire
    ));
    echo $_POST['serveur'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Serveurs/");


?>