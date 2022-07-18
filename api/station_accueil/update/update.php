<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['station'])){
    $id = $_POST['station'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $serie = $_POST['serie'];
    $mac = $_POST['mac'];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE station_accueil SET station_marque = :marque,
    station_modele = :modele,
    station_num_serie = :serie,
    station_adresse_mac = :mac,
    commentaire = :commentaire WHERE id_station = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":marque" => $marque ,
        ":modele" => $modele ,
        ":serie" => $serie ,
        ":mac" => $mac ,
        ":commentaire" => $commentaire
    ));
    echo $_POST['station'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Stations/");


?>