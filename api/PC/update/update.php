<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['pc'])){
    $id = $_POST['pc'];
    $date = $_POST['date'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $serie = $_POST['serie'];
    $artois = $_POST['artois'];
    $machine = $_POST['machine'];
    $MAC = $_POST['MAC'];
    $systeme = $_POST['systeme'];
    $RAM = $_POST['RAM'];
    $un = $_POST['un'];
    $deux = $_POST['deux'];
    $ordi = $_POST['ordi'];
    $appartenance = $_POST['appartenance'];
    $commentaire = $_POST['commentaire'];
    $reseau = $_POST['reseau'];
    $batiment = $_POST['batiment'];
    $etage = $_POST['etage'];
    $salle = $_POST['salle'];

    $IP = $_POST['IP'];    
    $ip = $_GET['ip'];    
    if(empty($ip))
    {
        unset($ip);
    }
    else{
        $req = "UPDATE ip set ip_adresse = :IP WHERE ip_adresse = :ip";
        $requete = $dbo->prepare($req);
        $requete->execute(array(':IP' => $IP, ':ip' => $ip));
    }


    $sql = "UPDATE pc SET pc_date_acquisition = :date,
    pc_marque = :marque,
    pc_modele = :modele,
    pc_num_serie = :serie,
    pc_num_inventaire_artois = :artois,
    pc_nom_machine = :machine,
    pc_adresse_mac = :MAC,
    pc_adresse_ip = :IP,
    pc_prise_reseau = :reseau,
    pc_systeme_exploitation = :systeme,
    pc_memoire_RAM = :RAM,
    id_bâtiment = :batiment,id_etage = :etage,id_salle = :salle,
    pc_taille_disque_1 = :un,
    pc_taille_disque_2 = :deux,
    pc_type = :ordi,
    pc_appartenance = :appartenance,
    id_bâtiment = :batiment,
    id_etage = :etage,
    id_salle = :salle,
    commentaire = :commentaire WHERE id_pc = :id";

    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ':id' => $id ,
        ':date' => $date ,
        ':marque' => $marque ,
        ':modele' => $modele , 
        ':serie' => $serie ,
        ':artois' => $artois ,
        ':machine' => $machine ,
        ':MAC' => $MAC ,
        ':IP' => $IP ,
        ':reseau' => $reseau ,
        ':systeme' => $systeme ,
        ':RAM' => $RAM ,
        ':batiment' => $batiment ,
        ':etage' => $etage ,
        ':salle' => $salle ,
        ':un' => $un ,
        ':deux' => $deux ,
        ':ordi' => $ordi ,
        ':appartenance' => $appartenance ,
        ':commentaire' => $commentaire
        ));
    echo $_POST['pc'];
}
else{
    echo "erreur";
}


header("location: /wordpress/PC/");


?>