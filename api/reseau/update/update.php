<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['reseau'])){
    $id = $_POST['reseau'];
    $reseau = $_POST['prise_reseau'];
    $connectique = $_POST['connectique'];
    $batiment = $_POST['batiment'];
    $etage = $_POST["etage"];
    $salle = $_POST["salle"];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE prise_reseau SET num_prise_reseau = :reseau,
    connectique = :connectique,
    id_bâtiment = :batiment,
    id_etage = :etage,
    id_salle = :salle,
    commentaire = :commentaire WHERE id_prise_reseau = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":reseau" => $reseau ,
        ":connectique" => $connectique ,
        ":batiment" => $batiment ,
        ':etage' => $etage,
        ':salle' => $salle,
        ":commentaire" => $commentaire
    ));
    echo $_POST['reseau'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Prises réseau/");


?>