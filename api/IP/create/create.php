<?php

require 'C:/xampp/htdocs/config.php';


$ip_ip = $_POST["ip_IP"];
$ip_affectation = $_POST["ip_affectation"];
$ip_actif = $_POST["ip_actif"];
$ip_mac = $_POST["ip_MAC"];
$ip_commentaire = $_POST["ip_commentaire"];

if (empty($ip_affectation))
{
    $ip_affectation = null;
}
if(!empty($ip_ip))
{
    $sql = "INSERT INTO ip (id_utiliser, ip_adresse, ip_actif, ip_adresse_mac, commentaire) 
    VALUES (:affectation, :ip, :actif, :mac, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':affectation' => $ip_affectation, 
        ':ip' => $ip_ip,
        ':actif' => $ip_actif, 
        ':mac' => $ip_mac,
        ':commentaire' => $ip_commentaire
    ));
}
$dbo = null;
?>