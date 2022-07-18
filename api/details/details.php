<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $req="SELECT * from personnel where id_personnel=$id";
    $requete = $dbo->prepare($req);
    $requete->execute();
    $res = $requete->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT personnel.id_personnel, personnel.personnel_nom, personnel.personnel_prenom, 
    utiliser.id_logiciel, utiliser.id_serveur, utiliser.id_ecran, utiliser.id_ip, utiliser.id_tablette, utiliser.id_appareil, utiliser.id_disque, utiliser.id_station, utiliser.id_pc, utiliser.id_cartouche, 
    logiciel.logiciel_nom, serveur.serveur_modele, ecran.ecran_modele, ip.ip_adresse, tablette.tablette_modele, appareil_mesure.appareil_modele, disque_dur.disque_modele, station_accueil.station_modele, pc.pc_modele,
    cartouche.cartouche_modele, imprimer.id_imprimante, imprimante.imprimante_modele, utiliser.id_utiliser
    FROM personnel
        LEFT JOIN utiliser
        ON personnel.id_personnel = utiliser.id_personnel
        LEFT JOIN logiciel
        ON logiciel.id_logiciel = utiliser.id_logiciel
        LEFT JOIN serveur
        ON serveur.id_serveur = utiliser.id_serveur
        LEFT JOIN ecran
        ON ecran.id_ecran = utiliser.id_ecran
        LEFT JOIN ip
        ON ip.id_ip = utiliser.id_ip
        LEFT JOIN tablette
        ON tablette.id_tablette = utiliser.id_tablette
        LEFT JOIN appareil_mesure
        ON appareil_mesure.id_appareil = utiliser.id_appareil
        LEFT JOIN disque_dur
        ON disque_dur.id_disque = utiliser.id_disque
        LEFT JOIN station_accueil
        ON station_accueil.id_station = utiliser.id_station
        LEFT JOIN pc
        ON pc.id_pc = utiliser.id_pc
        LEFT JOIN cartouche
        ON cartouche.id_cartouche = utiliser.id_cartouche
        LEFT JOIN imprimer
        ON personnel.id_personnel = imprimer.id_personnel
        LEFT JOIN imprimante
        ON imprimer.id_imprimante = imprimante.id_imprimante
        
        WHERE personnel.id_personnel = $id";

    

    // On prépare la requête

    $query = $dbo->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div>
        <?php
        foreach($res as $per){
            echo "<h3>" . "Liste de matériels de "  .  $per['personnel_nom'] . " " . $per['personnel_prenom'] . "</h3>";
        }
        ?>
    </div>
    <div>
        
        <div>
            <th>ID</th>
            <th>Logiciel</th>
            <th>Serveur</th>
            <th>Ecran</th>
            <th>IP</th>
            <th>Tablette</th>
            <th>Appareil de mesure</th>
            <th>Disque dur</th>
            <th>Station</th>
            <th>PC</th>
            <th>Cartouche</th>
            <th>Imprimante</th>
        </div>
        <div>
            <?php
            echo "<body>";
            
            foreach($result as $materiel){
                
                    echo "<tr>";
                        echo '<td style=text-align:center;>'; echo $materiel["id_utiliser"]; echo '</td>';
                        echo '<td style=text-align:center;><a href="/wordpress/crud/?id=' . $materiel['id_logiciel'] . '">'; echo $materiel["logiciel_nom"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/serveur/?id=' . $materiel['id_serveur'] . '">'; echo $materiel["serveur_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/ecran/?id=' . $materiel['id_ecran'] . '">'; echo $materiel["ecran_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/IP/?id=' . $materiel['id_ip'] . '">'; echo $materiel["ip_adresse"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/tablette/?id=' . $materiel['id_tablette'] . '">'; echo $materiel["tablette_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/appareil de mesure/?id=' . $materiel['id_appareil'] . '">'; echo $materiel["appareil_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/disque-dur/?id=' . $materiel['id_disque'] . '">'; echo $materiel["disque_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/station/?id=' . $materiel['id_station'] . '">'; echo $materiel["station_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/pc/?id=' . $materiel['id_pc'] . '">'; echo $materiel["pc_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/cartouche/?id=' . $materiel['id_cartouche'] . '">'; echo $materiel["cartouche_modele"]; echo '</a></td>';                    
                        echo '<td style=text-align:center;><a href="/wordpress/imprimante/?id=' . $materiel['id_imprimante'] . '">'; echo $materiel["imprimante_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/details/?id=' . $materiel['id_personnel'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/delete/delete.php?id=' . $materiel['id_personnel'] . '">Supprimer</a></td>';
                    echo "</tr>";
                
            echo "</body>";
            }
        
        ?>
        </div>
    </div>
    <?php
}
else{
    $req= "SELECT personnel.id_personnel, personnel.personnel_nom, personnel.personnel_prenom, 
    utiliser.id_logiciel, utiliser.id_serveur, utiliser.id_ecran, utiliser.id_ip, utiliser.id_tablette, utiliser.id_appareil, utiliser.id_disque, utiliser.id_station, utiliser.id_pc, utiliser.id_cartouche, 
    logiciel.logiciel_nom, serveur.serveur_modele, ecran.ecran_modele, ip.ip_adresse, tablette.tablette_modele, appareil_mesure.appareil_modele, disque_dur.disque_modele, station_accueil.station_modele, pc.pc_modele,
    cartouche.cartouche_modele, imprimer.id_imprimante, imprimante.imprimante_modele, utiliser.id_utiliser
    FROM utiliser
        LEFT JOIN personnel
        ON personnel.id_personnel = utiliser.id_personnel
        LEFT JOIN logiciel
        ON logiciel.id_logiciel = utiliser.id_logiciel
        LEFT JOIN serveur
        ON serveur.id_serveur = utiliser.id_serveur
        LEFT JOIN ecran
        ON ecran.id_ecran = utiliser.id_ecran
        LEFT JOIN ip
        ON ip.id_ip = utiliser.id_ip
        LEFT JOIN tablette
        ON tablette.id_tablette = utiliser.id_tablette
        LEFT JOIN appareil_mesure
        ON appareil_mesure.id_appareil = utiliser.id_appareil
        LEFT JOIN disque_dur
        ON disque_dur.id_disque = utiliser.id_disque
        LEFT JOIN station_accueil
        ON station_accueil.id_station = utiliser.id_station
        LEFT JOIN pc
        ON pc.id_pc = utiliser.id_pc
        LEFT JOIN cartouche
        ON cartouche.id_cartouche = utiliser.id_cartouche
        LEFT JOIN imprimer
        ON personnel.id_personnel = imprimer.id_personnel
        LEFT JOIN imprimante
        ON imprimer.id_imprimante = imprimante.id_imprimante";

    $requete = $dbo->prepare($req);
    $requete->execute();
    $res = $requete->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div>
        <?php
        echo "<h3>" . "Liste de matériels du personnel ";
        ?>
    </div>
    <div>
        
        <div>
            <th>ID</th>
            <th>Logiciel</th>
            <th>Serveur</th>
            <th>Ecran</th>
            <th>IP</th>
            <th>Tablette</th>
            <th>Appareil de mesure</th>
            <th>Disque dur</th>
            <th>Station</th>
            <th>PC</th>
            <th>Cartouche</th>
            <th>Imprimante</th>
        </div>
        <div>
            <?php
            echo "<body>";
            
            foreach($res as $details){
                
                    echo "<tr>";
                        echo '<td style=text-align:center;>'; echo $details["id_utiliser"]; echo '</td>';
                        echo '<td style=text-align:center;><a href="/wordpress/crud/?id=' . $details['id_logiciel'] . '">'; echo $details["logiciel_nom"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/serveur/?id=' . $details['id_serveur'] . '">'; echo $details["serveur_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/ecran/?id=' . $details['id_ecran'] . '">'; echo $details["ecran_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/IP/?id=' . $details['id_ip'] . '">'; echo $details["ip_adresse"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/tablette/?id=' . $details['id_tablette'] . '">'; echo $details["tablette_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/appareil de mesure/?id=' . $details['id_appareil'] . '">'; echo $details["appareil_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/disque-dur/?id=' . $details['id_disque'] . '">'; echo $details["disque_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/station/?id=' . $details['id_station'] . '">'; echo $details["station_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/pc/?id=' . $details['id_pc'] . '">'; echo $details["pc_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/cartouche/?id=' . $details['id_cartouche'] . '">'; echo $details["cartouche_modele"]; echo '</a></td>';                    
                        echo '<td style=text-align:center;><a href="/wordpress/imprimante/?id=' . $details['id_imprimante'] . '">'; echo $details["imprimante_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/details/?id=' . $details['id_personnel'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/delete/delete.php?id=' . $details['id_personnel'] . '">Supprimer</a></td>';
                    echo "</tr>";
                
            echo "</body>";
            }
        
        ?>
        </div>
    </div>
    <?php
}
?>
