<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['personnel'])){
    $id = $_POST['personnel'];
    $nom = $_POST['name'];
    $prenom = $_POST['prenom'];
    $statut = $_POST['statut'];
    $batiment = $_POST['batiment'];
    $etage = $_POST["etage"];
    $salle = $_POST["salle"];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE personnel SET personnel_nom = :nom,
    personnel_prenom = :prenom,
    personnel_statut = :statut,
    id_bâtiment = :batiment,
    id_etage = :etage,
    id_salle = :salle,
    commentaire = :commentaire WHERE id_personnel = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":nom" => $nom ,
        ":prenom" => $prenom ,
        ":statut" => $statut ,
        ":batiment" => $batiment ,
        ':etage' => $etage,
        ':salle' => $salle,
        ":commentaire" => $commentaire
    ));
    echo $_POST['personnel'];
}
else{
    echo "erreur";
}


header("location: /wordpress/personnel/");


?>