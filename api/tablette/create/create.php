<?php

require 'C:/xampp/htdocs/config.php';


$tablette_tactile = $_POST["tablette_tactile"];
$tablette_graphique = $_POST["tablette_graphique"];
$tablette_date = $_POST["tablette_date"];
$tablette_marque = $_POST["tablette_marque"];
$tablette_modele = $_POST["tablette_modele"];
$tablette_serie = $_POST["tablette_serie"];
$tablette_artois = $_POST["tablette_artois"];
$tablette_commentaire = $_POST["tablette_commentaire"];

if(!empty($tablette_tactile))
{
    $sql = "INSERT INTO tablette ( tablette_tactile,
    tablette_graphique,
    tablette_date_acquisition,
    tablette_marque,
    tablette_modele,
    tablette_num_serie,
    tablette_num_inventaire_artois,
    commentaire) 
    VALUES (:tactile,
    :graphique,
    :date,
    :marque,
    :modele,
    :serie,
    :artois,
    :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':tactile' => $tablette_tactile, 
        ':graphique' => $tablette_graphique,
        ':date' => $tablette_date,
        ':marque' => $tablette_marque,
        ':modele' => $tablette_modele,
        ':serie' => $tablette_serie,
        ':artois' => $tablette_artois,
        ':commentaire' => $tablette_commentaire,
    ));
}
$dbo = null;
?>