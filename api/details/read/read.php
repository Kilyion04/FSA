<?php

session_start();
require 'C:/xampp/htdocs/config.php';



// On écrit notre requête
$sql = "SELECT utiliser.id_personnel, personnel.personnel_nom, personnel.personnel_prenom, 
utiliser.id_serveur, utiliser.id_ecran, utiliser.id_ip, utiliser.id_tablette,
utiliser.id_appareil, utiliser.id_disque, utiliser.id_station, utiliser.id_pc,
serveur.serveur_modele, ecran.ecran_modele, ip.ip_adresse, tablette.tablette_modele,
appareil_mesure.appareil_modele, disque_dur.disque_modele, station_accueil.station_modele, pc.pc_modele,
utiliser.id_imprimante, imprimante.imprimante_modele, utiliser.id_utiliser
FROM utiliser
    LEFT JOIN personnel
    ON utiliser.id_personnel = personnel.id_personnel
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
    LEFT JOIN imprimer
    ON personnel.id_personnel = imprimer.id_personnel
    LEFT JOIN imprimante
    ON imprimer.id_imprimante = imprimante.id_imprimante";

$req = "SELECT utiliser.id_personnel, personnel.personnel_nom, personnel.personnel_prenom, 
utiliser.id_serveur, utiliser.id_ecran, utiliser.id_ip, utiliser.id_tablette,
utiliser.id_appareil, utiliser.id_disque, utiliser.id_station, utiliser.id_pc,
serveur.serveur_modele, ecran.ecran_modele, ip.ip_adresse, tablette.tablette_modele,
appareil_mesure.appareil_modele, disque_dur.disque_modele, station_accueil.station_modele, pc.pc_modele,
utiliser.id_imprimante, imprimante.imprimante_modele, utiliser.id_utiliser
FROM utiliser
    LEFT JOIN personnel
    ON personnel.id_personnel = utiliser.id_personnel
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
    LEFT JOIN imprimer
    ON personnel.id_personnel = imprimer.id_personnel
    LEFT JOIN imprimante
    ON imprimer.id_imprimante = imprimante.id_imprimante
WHERE personnel.id_personnel = :id";


// On prépare la requête
$query = $dbo->prepare($sql);

$requete = $dbo->prepare($req);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/start/jquery-ui.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    </head>
    <body>
        
        <div>
            
        <div>
        <th>ID</th>
            <th>Personnel</th>
            <th>Serveur</th>
            <th>Ecran</th>
            <th>IP</th>
            <th>Tablette</th>
            <th>Appareil de mesure</th>
            <th>Disque dur</th>
            <th>Station</th>
            <th>PC</th>
            <th>Imprimante</th>
    </div>
    <div>
        <?php
        echo "<tbody>";
        if(isset($_GET['nom']) && !empty($_GET['nom']) )
            {
                $id = $_GET['nom'];
                $terme = "%" . $id . "%";
                $term = "" . $id ."%";
                $requete->execute(array(
                    ':un'=> $id,
                    ':term'=> $term,
                    ':deux'=> $terme,
                    ':trois'=> $terme,
                    ':quatre'=> $terme,
                    ':cinq'=> $terme
                ));
                $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                foreach($trouver as $find)
                    {
                        echo "<tr>";
                        echo '<td style=text-align:center;>'; echo $find["id_utiliser"]; echo '</td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Personnel/?id=' . $find['id_personnel'] . '">'; echo $find["personnel_nom"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Serveurs/?id=' . $find['id_serveur'] . '">'; echo $find["serveur_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Ecrans/?id=' . $find['id_ecran'] . '">'; echo $find["ecran_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/IP/?id=' . $find['id_ip'] . '">'; echo $find["ip_adresse"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Tablettes/?id=' . $find['id_tablette'] . '">'; echo $find["tablette_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Appareils de mesure/?id=' . $find['id_appareil'] . '">'; echo $find["appareil_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Disques dur/?id=' . $find['id_disque'] . '">'; echo $find["disque_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Stations/?id=' . $find['id_station'] . '">'; echo $find["station_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/PC/?id=' . $find['id_pc'] . '">'; echo $find["pc_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Imprimantes/?id=' . $find['id_imprimante'] . '">'; echo $find["imprimante_modele"]; echo '</a></td>';
                        echo '<td style=text-align:center;><a href="/wordpress/Details/?id=' . $find['id_utiliser'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/details/delete/delete.php?id=' . $find['id_utiliser'] . '">Supprimer</a></td>';
                            echo "</tr>";
                    }
            }
        else
        {
            foreach($result as $details){
                
                if(isset($_GET['id']) && $details['id_utiliser'] == $_GET['id'])
                {
                    echo '<td colspan="3"><form action="/api/details/update/update.php" method="POST">';
                    echo "ID n° " ;echo $details['id_utiliser'];
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="personnel" value="' . $details['id_personnel'] . '" placeholder="ID du personnel" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="serveur" value="' . $details['id_serveur'] . '" placeholder="ID du serveur" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="ecran" value="' . $details['id_ecran'] . '" placeholder="ID de l\'écran" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="ip" value="' . $details['id_ip'] . '" placeholder="ID de l\'adresse IP" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="tablette" value="' . $details['id_tablette'] . '" placeholder="ID de la tablette" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="appareil" value="' . $details['id_appareil'] . '" placeholder="ID de l\'appareil de mesure" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="disque" value="' . $details['id_disque'] . '" placeholder="ID du disque" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="station" value="' . $details['id_station'] . '" placeholder="ID de la station d\'accueil autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="pc" value="' . $details['id_pc'] . '" placeholder="ID du PC" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="number" name="imprimante" value="' . $details['id_imprimante'] . '" placeholder="ID de l\'imprimante" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="details" value="' . $details['id_utiliser'] . '">';
                    echo "</form></td>";
                    
                }

                else
                {
                    echo "<tr>";
                    echo '<td style=text-align:center;>'; echo $details["id_utiliser"]; echo '</td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Personnel/?id=' . $details['id_personnel'] . '">'; echo $details["personnel_nom"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Serveurs/?id=' . $details['id_serveur'] . '">'; echo $details["id_serveur"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Ecrans/?id=' . $details['id_ecran'] . '">'; echo $details["id_ecran"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/IP/?id=' . $details['id_ip'] . '">'; echo $details["id_ip"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Tablettes/?id=' . $details['id_tablette'] . '">'; echo $details["id_tablette"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Appareils de mesure/?id=' . $details['id_appareil'] . '">'; echo $details["id_appareil"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Disques dur/?id=' . $details['id_disque'] . '">'; echo $details["id_disque"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Stations/?id=' . $details['id_station'] . '">'; echo $details["id_station"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/PC/?id=' . $details['id_pc'] . '">'; echo $details["id_pc"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Imprimantes/?id=' . $details['id_imprimante'] . '">'; echo $details["id_imprimante"]; echo '</a></td>';
                    echo '<td style=text-align:center;><a href="/wordpress/Details/?id=' . $details['id_utiliser'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/details/delete/delete.php?id=' . $details['id_utiliser'] . '">Supprimer</a></td>';
                echo "</tr>";
                }
            }
        }
        echo "</tbody>";
        ?>
        </div>
        </div>
        <script>
            $(document).ready(function() {
            //////////////////////////

            $( "#t1" ).autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "autocomplete-source2.php",
                        type: "GET",
                        data: request,
                        dataType: 'json',
                        success: function (data) {
                            response($.map(data, function (el) {
                                return {
                                    label: el.label,
                                    value: el.value
                                };
                            }));
                        }
                    });
                },
            select:function (e, ui) {
            e.preventDefault(); // uncomment if you want to display name in place of id
            $("#t1").val(ui.item.label); // uncomment if you want to display name in place of id

            $("#d1").load("autocomplete-record.php?id="+ui.item.value);
            },
            focus: function(event, ui) {
                    event.preventDefault();
                    $("#t1").val(ui.item.label);
                }
            });

            //////
            })
        </script> 
    </body>
</html>