<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['appareil'])){
    $id = $_POST['appareil'];
    $marque = $_POST['marque'];
    $type = $_POST["type"];
    $modele = $_POST["modele"];
    $mac = $_POST["mac"];
    $ip = $_POST["ip"];
    $reseau = $_POST["reseau"];
    $batiment = $_POST["batiment"];
    $etage = $_POST["etage"];
    $salle = $_POST["salle"];
    $commentaire = $_POST["commentaire"];

    
    $sql = "UPDATE appareil_mesure SET 
    appareil_marque = :marque, 
    appareil_type = :type, 
    appareil_modele = :modele, 
    appareil_adresse_mac = :mac,
    appareil_adresse_ip = :ip,
    prise_reseau = :reseau,
    bâtiment = :batiment,
    etage = :etage,
    salle = :salle,
    commentaire = :commentaire
    WHERE id_appareil = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":marque" => $marque,
        ':type' => $type, 
        ':modele' => $modele,
        ':mac' => $mac,
        ':ip' => $ip,
        ':reseau' => $reseau,
        ':batiment' => $batiment,
        ':etage' => $etage,
        ':salle' => $salle,
        ':commentaire' => $commentaire 
    ));
    echo $_POST['appareil'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Appareils de mesure/");


?>