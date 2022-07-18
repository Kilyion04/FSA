<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['disque'])){
    $id = $_POST['disque'];
    $marque = $_POST["marque"];
    $modele = $_POST["modele"];
    $taille = $_POST["taille"];
    $mac = $_POST["MAC"];
    $IP = $_POST["IP"];
    $reseau = $_POST["reseau"];
    $commentaire = $_POST["commentaire"];
    
    $sql = "UPDATE disque_dur SET disque_marque = :marque,
    disque_modele = :modele,
    disque_taille = :taille,
    disque_adresse_mac = :mac,
    ip_adresse = :IP,
    num_prise_reseau = :reseau,
    commentaire = :commentaire WHERE id_disque = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ':marque' => $marque,
        ':modele' => $modele, 
        ':taille' => $taille,
        ':mac' => $mac,
        ':IP' => $IP,
        ':reseau' => $reseau,
        ':commentaire' => $commentaire,
    ));
    echo $_POST['disque'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Disques dur/");


?>