<?php

require 'C:/xampp/htdocs/config.php';


$ecran_marque = $_POST["ecran_marque"];
$ecran_modele = $_POST["ecran_modele"];
$ecran_serie = $_POST["ecran_serie"];
$ecran_taille = $_POST["ecran_taille"];
$ecran_HDMI = $_POST["ecran_HDMI"];
$ecran_DP = $_POST["ecran_DP"];
$ecran_DVI = $_POST["ecran_DVI"];
$ecran_VGA = $_POST["ecran_VGA"];
$ecran_commentaire = $_POST["ecran_commentaire"];

if(!empty($ecran_marque))
{
    $sql = "INSERT INTO ecran (ecran_marque, ecran_modele, ecran_num_serie,
    ecran_taille,
    ecran_HDMI,
    ecran_Displayport,
    ecran_DVI,
    ecran_VGA,
    commentaire) 
    VALUES (:marque, :modele, :serie, :taille, :HDMI, :DP, :DVI, :VGA, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':marque' => $ecran_marque,
        ':modele' => $ecran_modele, 
        ':serie' => $ecran_serie,
        ':taille' => $ecran_taille,
        ':HDMI' => $ecran_HDMI,
        ':DP' => $ecran_DP,
        ':DVI' => $ecran_DVI,
        ':VGA' => $ecran_VGA,
        ':commentaire' => $ecran_commentaire,
    ));
}
$dbo = null;
?>