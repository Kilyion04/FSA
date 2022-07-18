<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['logiciel'])){
    $id = $_POST['logiciel'];
    $editeur = $_POST['editeur'];
    $nom = $_POST['nom'];
    $version = $_POST['version'];
    $officiel = $_POST['officiel'];
    $type = $_POST['type'];
    $commentaire = $_POST['commentaire'];
    
    $sql = "UPDATE logiciel SET logiciel_editeur = :editeur,
    logiciel_nom = :nom,
    logiciel_version = :version,
    logiciel_off = :officiel,
    logiciel_type = :type,
    commentaire = :commentaire WHERE id_logiciel = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":editeur" => $editeur ,
        ":nom" => $nom ,
        ":version" => $version ,
        ":officiel" => $officiel ,
        ":type" => $type ,
        ":commentaire" => $commentaire
    ));
    echo $_POST['logiciel'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Logiciels/");


?>