<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['tablette'])){
    $id = $_POST['tablette'];
    $tactile = $_POST['tactile'];
    $graphique = $_POST['graphique'];
    $date = $_POST['date'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $num_serie = $_POST['serie'];
    $artois = $_POST['artois'];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE tablette SET tablette_tactile = :tactile,
    tablette_graphique = :graphique,
    tablette_date_acquisition = :date,
    tablette_marque = :marque,
    tablette_modele = :modele,
    tablette_num_serie = :num_serie,
    tablette_num_inventaire_artois = :artois,
    commentaire = :commentaire
    WHERE id_tablette = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":tactile" => $tactile ,
        ":graphique" => $graphique ,
        ":date" => $date ,
        ":marque" => $marque ,
        ":modele" => $modele ,
        ":num_serie" => $num_serie ,
        ":artois" => $artois ,
        ":commentaire" => $commentaire
    ));
    echo $_POST['tablette'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Tablettes/");


?>