<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['cartouche'])){
    $id = $_POST['cartouche'];
    $marque = $_POST['marque'];
    $quantite = $_POST['quantite'];
    $modele = $_POST['modele'];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE cartouche SET cartouche_marque = :marque,
    cartouche_quantite = :quantite,
    cartouche_modele = :modele,
    commentaire = :commentaire WHERE id_cartouche = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":marque" => $marque ,
        ":quantite" => $quantite ,
        ":modele" => $modele ,
        ":commentaire" => $commentaire
    ));
    echo $_POST['cartouche'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Cartouches/");


?>