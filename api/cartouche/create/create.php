<?php

require 'C:/xampp/htdocs/config.php';


$cartouche_marque = $_POST["cartouche_marque"];
$cartouche_quantite = $_POST["cartouche_quantite"];
$cartouche_modele = $_POST["cartouche_modele"];
$cartouche_commentaire = $_POST["cartouche_commentaire"];

if(!empty($cartouche_marque))
{
    $sql = "INSERT INTO cartouche (cartouche_marque, cartouche_quantite, cartouche_modele, commentaire) 
    VALUES (:marque, :quantite, :modele, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':marque' => $cartouche_marque,
        ':quantite' => $cartouche_quantite, 
        ':modele' => $cartouche_modele,
        ':commentaire' => $cartouche_commentaire,
    ));
}

$dbo = null;
?>