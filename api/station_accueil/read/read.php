<?php

session_start();
require 'C:/xampp/htdocs/config.php';


// On écrit notre requête
$sql = "SELECT * FROM station_accueil";

$req = "SELECT * FROM station_accueil
WHERE id_station like :un OR
id_station like :term OR
station_marque like :deux OR
station_modele like :trois OR
station_num_serie like :quatre OR
station_adresse_mac like :cinq OR
commentaire like :six
";

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
        <th>Marque</th>
        <th>Modèle</th>
        <th>N° série</th>
        <th>Adresse mac</th>
        <th>Commentaire</th>
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
                    ':cinq'=> $terme,
                    ':six'=> $terme
                ));
                $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                foreach($trouver as $find)
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $find['id_station'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['station_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['station_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['station_num_serie'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['station_adresse_mac'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Stations/?id=' . $find['id_station'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/station_accueil/delete/delete.php?id=' . $find['id_station'] . '">Supprimer</a></td>';
                        echo "</tr>";
                    }
            }
        else
        {
            foreach($result as $station){
                
                if(isset($_GET['id']) && $station['id_station'] == $_GET['id'])
                {
                    echo '<td style=text-align:center; colspan="3"><form action="/api/station_accueil/update/update.php" method="POST">';
                    echo "ID n° " ;echo $station['id_station'] . ' ' .  $station['station_marque'] . ' ' .  $station['station_modele'] . ' ' .  $station['station_num_serie'];
                    ?><br><br><?php
                    echo '<input type="text" name="marque" value="' . $station['station_marque'] . '" placeholder="Marque">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="modele" value="' . $station['station_modele'] . '" placeholder="Modèle">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="serie" value="' . $station['station_num_serie'] . '" placeholder="N° série">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="mac" value="' . $station['station_adresse_mac'] . '" placeholder="N° série">';
                    ?><br>
                    <br><?php
                    
                    echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $station['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="station" value="' . $station['id_station'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $station['id_station'] . "</td>";
                    echo "<td style=text-align:center;>" . $station['station_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $station['station_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $station['station_num_serie'] . "</td>";
                    echo "<td style=text-align:center;>" . $station['station_adresse_mac'] . "</td>";
                    echo "<td style=text-align:center;>" . $station['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Stations/?id=' . $station['id_station'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/station_accueil/delete/delete.php?id=' . $station['id_station'] . '">Supprimer</a></td>';
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