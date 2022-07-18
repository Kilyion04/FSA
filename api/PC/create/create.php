<?php

require 'C:/xampp/htdocs/config.php';

$pc_marque =$_POST['pc_marque'];
$pc_date =$_POST['pc_date'];
$pc_modele =$_POST['pc_modele'];
$pc_serie =$_POST['pc_serie'];
$pc_artois =$_POST['pc_artois'];
$pc_machine =$_POST['pc_machine'];
$pc_mac =$_POST['pc_mac'];
$pc_IP =$_POST['pc_ip'];
$pc_reseau =$_POST['pc_reseau'];
$pc_systeme =$_POST['pc_systeme'];
$pc_RAM =$_POST['pc_RAM'];
$pc_un =$_POST['pc_un'];
$pc_deux =$_POST['pc_deux'];
$pc_ordi =$_POST['pc_ordi'];
$pc_appartenance =$_POST['pc_appartenance'];
$pc_batiment =$_POST['pc_batiment'];
$pc_etage =$_POST['pc_etage'];
$pc_salle =$_POST['pc_salle'];
$pc_commentaire =$_POST['pc_commentaire'];


/* Correspond à un trigger sql, on test si l'ip et la prise réseau sont nulle ou non
- Si nulle 
on n'insere aucune données dans les table ip et prise réseau
- Si contient données
on insère les saisies dans ip.ip_adresse et prise_reseau.num_prise_reseau
+ localisation prise reseau = localisation du matériel
*/



if(!empty($pc_marque))
{
    if(!empty($pc_reseau))
    {
    $req = "INSERT INTO prise_reseau (num_prise_reseau) VALUES (:reseau)";
    $requete = $dbo->prepare($req);
    $requete->execute(array(':reseau' => $pc_reseau));
    }
    else{
    }

    if(!empty($pc_IP))
        {
        $reqip = "INSERT INTO ip (ip_adresse, ip_adresse_mac) VALUES (:ip, :mac)";
        $requeteip = $dbo->prepare($reqip);
        $requeteip->execute(array(':ip' => $pc_IP, ':mac' => $pc_mac ));
        }
    else{
    }

    $sql = "INSERT INTO pc (pc_date_acquisition,
    pc_marque,
    pc_modele,
    pc_num_serie,
    pc_num_inventaire_artois,
    pc_nom_machine,
    pc_adresse_mac,
    pc_adresse_ip,
    pc_prise_reseau,
    pc_systeme_exploitation,
    pc_memoire_RAM,
    pc_taille_disque_1,
    pc_taille_disque_2,
    pc_type,
    pc_appartenance,
    id_bâtiment,
    id_etage,
    id_salle,
    commentaire) 
    VALUES (:date,
    :marque,
    :modele,
    :serie,
    :artois,
    :machine,
    :mac,
    :IP,
    :reseau,
    :systeme,
    :RAM,
    :un,
    :deux,
    :ordi,
    :appartenance,
    :batiment,
    :etage,
    :salle,
    :commentaire)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':date' => $pc_date,
        ':marque' => $pc_marque,
        ':modele' => $pc_modele, 
        ':serie' => $pc_serie ,
        ':artois' => $pc_artois ,
        ':machine' => $pc_machine ,
        ':mac' => $pc_mac,
        ':systeme' => $pc_systeme ,
        ':RAM' => $pc_RAM ,
        ':IP' => $pc_IP ,
        ':reseau' => $pc_reseau,
        ':un' => $pc_un ,
        ':deux' => $pc_deux ,
        ':ordi' => $pc_ordi ,
        ':batiment' => $pc_batiment ,
        ':etage' => $pc_etage ,
        ':salle' => $pc_salle ,
        ':appartenance' => $pc_appartenance ,
        ':commentaire' => $pc_commentaire
    ));
}

$dbo = null;
?>