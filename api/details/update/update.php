<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST["details"])){
    $id = $_POST["details"];
    $id_personnel = $_POST["personnel"];
    $id_serveur = $_POST["serveur"];
    $id_ecran = $_POST["ecran"];
    $id_ip = $_POST["ip"];
    $id_tablette = $_POST["tablette"];
    $id_appareil = $_POST["appareil"];
    $id_disque = $_POST["disque"];
    $id_station = $_POST["station"];
    $id_pc = $_POST["pc"];
    $id_imprimante = $_POST["imprimante"];
    
    $sql = "UPDATE utiliser SET
    id_personnel = :id_personnel,
    id_serveur = :id_serveur,
    id_ecran = :id_ecran,
    id_ip = :id_ip,
    id_tablette = :id_tablette,
    id_appareil = :id_appareil,
    id_disque = :id_disque,
    id_station = :id_station,
    id_pc = :id_pc,
    id_imprimante = :id_imprimante
    WHERE id_utiliser = :id_utiliser";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ':id_utiliser' => $id,
        ':id_personnel' => $id_personnel,
        ':id_serveur' => $id_serveur,
        ':id_ecran' => $id_ecran,
        ':id_ip' => $id_ip,
        ':id_tablette' => $id_tablette,
        ':id_appareil' => $id_appareil,
        ':id_disque' => $id_disque,
        ':id_station' => $id_station,
        ':id_pc' => $id_pc,
        ':id_imprimante' => $id_imprimante
    ));
}
else{
    echo "erreur";
}
header("location: /wordpress/details/");


?>


