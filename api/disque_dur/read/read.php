<?php

session_start();
require 'C:/xampp/htdocs/config.php';

// On écrit notre requête
$sql = "SELECT * FROM disque_dur
";

$req = "SELECT * FROM disque_dur
WHERE id_disque like :un OR
id_disque like :term OR
disque_marque like :deux OR
disque_modele like :trois OR
disque_taille like :quatre OR
disque_adresse_mac like :cinq OR
ip_adresse like :six OR
num_prise_reseau like :sept OR
commentaire like :huit
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
        <th>Taille</th>
        <th>Adresse MAC</th>
        <th>Adresse IP</th>
        <th>Prise réseau</th>
        <th>Commentaire</th>
    </thead>
    <tbody>
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
                ':huit'=> $terme
            ));
            $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

            foreach($trouver as $find){
                echo "<tr>";
                    echo "<td style=text-align:center;>" . $find['id_disque'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['disque_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['disque_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['disque_taille'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['disque_adresse_mac'] . "</td>";
                    echo "<td style=text-align:center;><a href='http://localhost/wordpress/ip/?id='>" . $find['ip_adresse'] . "</a></td>";
                    echo "<td style=text-align:center;><a href='http://localhost/wordpress/reseau/?id='>" . $find['num_prise_reseau'] . "</a></td>";
                    echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Disques dur/?id=' . $find['id_disque'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/disque_dur/delete/delete.php?id=' . $find['id_disque'] . '">Supprimer</a></td>';
                echo "</tr>";
            }
        }
        else
        {
            foreach($result as $disque){
                
                if(isset($_GET['id']) && $disque['id_disque'] == $_GET['id'])
                {
                    echo '<td colspan="3"><form action="/api/disque_dur/update/update.php" method="POST">';
                    echo "ID n° " ;echo $disque['id_disque'] . ' ' .  $disque['disque_marque'] . ' ' .  $disque['disque_modele'] . ' ' .  $disque['disque_taille'];
                    ?><br><br><?php
                    echo '<input type="text" name="marque" value="' . $disque['disque_marque'] . '" placeholder="Marque">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="modele" value="' . $disque['disque_modele'] . '" placeholder="Modèle">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="taille" value="' . $disque['disque_taille'] . '" placeholder="Taille">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="MAC" value="' . $disque['disque_adresse_mac'] . '" placeholder="Adresse MAC">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="IP" value="' . $disque['ip_adresse'] . '" placeholder="Adresse IP">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="reseau" value="' . $disque['num_prise_reseau'] . '" placeholder="Prise réseau">';
                    ?><br>
                    <br><?php
                    echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $disque['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="disque" value="' . $disque['id_disque'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $disque['id_disque'] . "</td>";
                    echo "<td style=text-align:center;>" . $disque['disque_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $disque['disque_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $disque['disque_taille'] . "</td>";
                    echo "<td style=text-align:center;>" . $disque['disque_adresse_mac'] . "</td>";
                    echo "<td style=text-align:center;><a href='http://localhost/wordpress/ip/?id='>" . $disque['ip_adresse'] . "</a></td>";
                    echo "<td style=text-align:center;><a href='http://localhost/wordpress/reseau/?id='>" . $disque['num_prise_reseau'] . "</a></td>";
                    echo "<td style=text-align:center;>" . $disque['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Disques dur/?id=' . $disque['id_disque'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/disque_dur/delete/delete.php?id=' . $disque['id_disque'] . '">Supprimer</a></td>';
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