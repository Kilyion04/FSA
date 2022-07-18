<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['ecran'])){
    $id = $_POST['ecran'];
    $marque = $_POST["marque"];
    $modele = $_POST["modele"];
    $serie = $_POST["serie"];
    $taille = $_POST["taille"];
    $HDMI = $_POST["HDMI"];
    $DP = $_POST["DP"];
    $DVI = $_POST["DVI"];
    $VGA = $_POST["VGA"];
    $commentaire = $_POST["commentaire"];
    
    $sql = "UPDATE ecran SET ecran_marque = :marque,
    ecran_modele = :modele,
    ecran_num_serie = :serie,
    ecran_taille = :taille,
    ecran_HDMI = :HDMI,
    ecran_Displayport = :DP,
    ecran_DVI = :DVI,
    ecran_VGA = :VGA,
    commentaire = :commentaire WHERE id_ecran = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ':marque' => $marque,
        ':modele' => $modele, 
        ':serie' => $serie,
        ':taille' => $taille,
        ':HDMI' => $HDMI,
        ':DP' => $DP,
        ':DVI' => $DVI,
        ':VGA' => $VGA,
        ':commentaire' => $commentaire,
    ));
    echo $_POST['ecran'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Ecrans/");


?>