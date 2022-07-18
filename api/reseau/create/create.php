<?php

require 'C:/xampp/htdocs/config.php';


$prise_reseau = $_POST["prise_reseau"];
$prise_connectique = $_POST["prise_connectique"];
$prise_batiment = $_POST["prise_batiment"];
$prise_etage = $_POST["prise_etage"];
$prise_salle = $_POST["prise_salle"];
$prise_commentaire = $_POST["prise_commentaire"];

if(!empty($prise_reseau))
{
    $sql = "INSERT INTO prise_reseau (num_prise_reseau, connectique,
    id_bâtiment, id_etage, id_salle, commentaire) 
    VALUES (:reseau,:connectique , :batiment, :etage, :salle, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':reseau' => $prise_reseau,
        ':connectique' => $prise_connectique, 
        ':batiment' => $prise_batiment,
        ':etage' => $prise_etage,
        ':salle' => $prise_salle,
        ':commentaire' => $prise_commentaire,
    ));
}
$dbo = null;
?>

