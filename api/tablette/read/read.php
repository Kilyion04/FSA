<?php

session_start();
require 'C:/xampp/htdocs/config.php';



// On écrit notre requête
$sql = "SELECT * FROM tablette";

$req = "SELECT * FROM tablette
WHERE id_tablette like :un OR
id_tablette like :term OR
tablette_tactile like :deux OR
tablette_graphique like :trois OR
tablette_date_acquisition like :quatre OR
tablette_marque like :cinq OR
tablette_modele like :six OR
tablette_num_serie like :sept OR
tablette_num_inventaire_artois like :huit OR
commentaire like :neuf
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
        <th>Tactile</th>
        <th>Graphique</th>
        <th>Date d'acquisition</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>N° de série</th>
        <th>N° inventaire Artois</th>
        <th>Commentaire</th>
    </div><div>
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
                    ':six'=> $terme,
                    ':sept'=> $terme,
                    ':huit'=> $terme,
                    ':neuf'=> $terme
                ));
                $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                foreach($trouver as $find)
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $find['id_tablette'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['tablette_tactile'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['tablette_graphique'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['tablette_date_acquisition'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['tablette_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['tablette_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['tablette_num_serie'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['tablette_num_inventaire_artois'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Tablettes/?id=' . $find['id_tablette'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/tablette/delete/delete.php?id=' . $find['id_tablette'] . '">Supprimer</a></td>';
                        echo "</tr>";
                    }
            }
        else
        {
            foreach($result as $tablette){
                
                if(isset($_GET['id']) && $tablette['id_tablette'] == $_GET['id'])
                {
                    echo '<td style=text-align:center; colspan="3"><form action="/api/tablette/update/update.php" method="POST">';
                    echo "ID n° " ;echo $tablette['id_tablette'] . ' ' .  $tablette['tablette_tactile'] . ' ' .  $tablette['tablette_graphique'] . ' ' .  $tablette['tablette_date_acquisition'];
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="tactile" value="' . $tablette['tablette_tactile'] . '" placeholder="Tactile">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="graphique" value="' . $tablette['tablette_graphique'] . '" placeholder="Graphique">';
                    ?><br>
                    <br><?php
                    echo '<input type="date" name="date" value="' . $tablette['tablette_date_acquisition'] . '" placeholder="Date d\'\acquisition">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="marque" value="' . $tablette['tablette_marque'] . '" placeholder="Marque">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="modele" value="' . $tablette['tablette_modele'] . '" placeholder="Modèle">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="serie" value="' . $tablette['tablette_num_serie'] . '" placeholder="N° de série">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="artois" value="' . $tablette['tablette_num_inventaire_artois'] . '" placeholder="N° d\'\inventaire Artois">';
                    ?><br>
                    <br><?php
                    echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $tablette['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="tablette" value="' . $tablette['id_tablette'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $tablette['id_tablette'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['tablette_tactile'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['tablette_graphique'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['tablette_date_acquisition'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['tablette_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['tablette_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['tablette_num_serie'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['tablette_num_inventaire_artois'] . "</td>";
                    echo "<td style=text-align:center;>" . $tablette['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Tablettes/?id=' . $tablette['id_tablette'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/tablette/delete/delete.php?id=' . $tablette['id_tablette'] . '">Supprimer</a></td>';
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