<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['ip'])){
    $id = $_POST['ip'];
    $ip = $_POST['adresse'];
    $affectation = $_POST['affectation'];
    $actif = $_POST['actif'];
    $mac = $_POST['mac'];
    $commentaire = $_POST['commentaire'];

    if (empty($affectation))
    {
        $affectation = null;
    }
    
    $sql = "UPDATE ip SET ip.ip_adresse = :ip,
    ip.id_utiliser = :affectation,
    ip_actif = :actif,
    ip_adresse_mac = :mac,
    commentaire = :commentaire WHERE id_ip = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":ip" => $ip ,
        ":affectation" => $affectation ,
        ":actif" => $actif ,
        ":mac" => $mac ,
        ":commentaire" => $commentaire
    ));
    echo $_POST['personnel'];
}
else{
    echo "erreur";
}


header("location: /wordpress/IP/");


?>

