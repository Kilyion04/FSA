<?php

require 'T:\cesi\A2\web\xamp\htdocs\config.php';


$personnel_nom = $_POST["personnel_nom"];
$personnel_prenom = $_POST["personnel_prenom"];
$personnel_statut = $_POST["personnel_statut"];
$personnel_batiment = $_POST["personnel_batiment"];
$personnel_etage = $_POST["personnel_etage"];
$personnel_salle = $_POST["personnel_salle"];
$personnel_commentaire = $_POST["personnel_commentaire"];

if(!empty($personnel_nom))
{
    $sql = "INSERT INTO personnel (personnel_nom, personnel_prenom, personnel_statut,
    id_bâtiment, id_etage, id_salle, commentaire) 
    VALUES (:nom, :prenom, :statut, :batiment, :etage, :salle, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':nom' => $personnel_nom,
        ':prenom' => $personnel_prenom, 
        ':statut' => $personnel_statut,
        ':batiment' => $personnel_batiment,
        ':etage' => $personnel_etage,
        ':salle' => $personnel_salle,
        ':commentaire' => $personnel_commentaire
    ));
}

header("location: /wordpress/personnel/");

$dbo = null;
?>
