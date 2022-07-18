<?php

require 'C:/xampp/htdocs/config.php';


$logs_pc = $_POST["logs_pc"];
$logs_serveur = $_POST["logs_serveur"];
$logs_perso = $_POST["logs_perso"];
$logs_1 = $_POST["logs_1"];
$logs_2 = $_POST["logs_2"];
$logs_3 = $_POST["logs_3"];
$logs_4 = $_POST["logs_4"];
$logs_5 = $_POST["logs_5"];
$logs_6 = $_POST["logs_6"];
$logs_7 = $_POST["logs_7"];
$logs_8 = $_POST["logs_8"];
$logs_9 = $_POST["logs_9"];
$logs_10 = $_POST["logs_10"];
$logs_commentaire = $_POST["logs_commentaire"];

if(!empty($logs_1))
{
    $sql = "INSERT INTO logs (logs_pc,
    logs_serveur,
    logs_perso,
    logs_1,
    logs_2,
    logs_3,
    logs_4,
    logs_5,
    logs_6,
    logs_7,
    logs_8,
    logs_9,
    logs_10,
    logs_commentaire) 
    VALUES (:logs_pc, :logs_serveur, :logs_perso, :logs_1, :logs_2, :logs_3, :logs_4, :logs_5, :logs_6, :logs_7, :logs_8, :logs_9, :logs_10, :logs_commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':logs_pc' => $logs_pc,
        ':logs_serveur' => $logs_serveur, 
        ':logs_perso' => $logs_perso,
        ':logs_1' => $logs_1,
        ':logs_2' => $logs_2,
        ':logs_3' => $logs_3,
        ':logs_4' => $logs_4,
        ':logs_5' => $logs_5,
        ':logs_6' => $logs_6,
        ':logs_7' => $logs_7,
        ':logs_8' => $logs_8,
        ':logs_9' => $logs_9,
        ':logs_10' => $logs_10,
        ':logs_commentaire' => $logs_commentaire
));
}
$dbo = null;
?>

