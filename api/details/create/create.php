<?php

require 'C:/xampp/htdocs/config.php';


$utiliser_id_id_personnel = $_POST["utiliser_personnel"];
$utiliser_id_id_logiciel = $_POST["utiliser_logiciel"];
$utiliser_id_id_serveur = $_POST["utiliser_serveur"];
$utiliser_id_id_ecran = $_POST["utiliser_ecran"];
$utiliser_id_id_ip = $_POST["utiliser_ip"];
$utiliser_id_id_tablette = $_POST["utiliser_tablette"];
$utiliser_id_id_appareil = $_POST["utiliser_appareil"];
$utiliser_id_id_disque = $_POST["utiliser_disque"];
$utiliser_id_id_station = $_POST["utiliser_station"];
$utiliser_id_id_pc = $_POST["utiliser_pc"];
$utiliser_id_id_imprimante = $_POST["utiliser_imprimante"];

$sql = "INSERT INTO utiliser (id_personnel, id_logiciel, id_serveur,
id_ecran, id_ip, id_tablette, id_appareil, id_disque, id_station, id_pc, id_imprimante)
VALUES (:id_personnel, :id_logiciel, :id_serveur, :id_ecran,
:id_ip, :id_tablette, :id_appareil, :id_disque, :id_station, :id_pc, :id_imprimante)";
$stmt= $dbo->prepare($sql);
$stmt->execute(array(
    ':id_personnel' => $utiliser_id_id_personnel,
    ':id_logiciel' => $utiliser_id_id_logiciel,
    ':id_serveur' => $utiliser_id_id_serveur,
    ':id_ecran' => $utiliser_id_id_ecran,
    ':id_ip' => $utiliser_id_id_ip,
    ':id_tablette' => $utiliser_id_id_tablette,
    ':id_appareil' => $utiliser_id_id_appareil,
    ':id_disque' => $utiliser_id_id_disque,
    ':id_station' => $utiliser_id_id_station,
    ':id_pc' => $utiliser_id_id_pc,
    ':id_imprimante' => $utiliser_id_id_imprimante
));

$dbo = null;
?>

