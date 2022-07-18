<?php

require 'C:/xampp/htdocs/config.php';


$logiciel_editeur = $_POST["logiciel_editeur"];
$logiciel_nom = $_POST["logiciel_nom"];
$logiciel_version = $_POST["logiciel_version"];
$logiciel_officiel = $_POST["logiciel_officiel"];
$logiciel_type = $_POST["logiciel_type"];
$logiciel_commentaire = $_POST["logiciel_commentaire"];

if(!empty($logiciel_editeur))
{
    $sql = "INSERT INTO logiciel (logiciel_editeur,
    logiciel_nom,
    logiciel_version,
    logiciel_of,
    logiciel_type,
    logiciel_commentaire) 
    VALUES (:editeur, :nom, :versions, :officiel, :types, :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':editeur' => $logiciel_editeur,
        ':nom' => $logiciel_nom,
        ':versions' => $logiciel_version,
        ':officiel' => $logiciel_officiel,
        ':types' => $logiciel_type,
        ':commentaire' => $logiciel_commentaire
));
}



$dbo = null;
?>

