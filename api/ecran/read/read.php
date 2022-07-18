<?php

session_start();
require 'C:/xampp/htdocs/config.php';

// On écrit notre requête
$sql = "SELECT * from ecran";

$req = "SELECT * from ecran 
WHERE id_ecran like :un OR
id_ecran like :term OR
ecran_marque like :deux OR
ecran_modele like :trois OR
ecran_num_serie like :quatre OR
ecran_taille like :cinq OR
ecran_HDMI like :six OR
ecran_Displayport like :sept OR
ecran_DVI like :huit OR
ecran_VGA like :neuf 
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
        <th>Taille</th>
        <th>HDMI</th>
        <th>Displayport</th>
        <th>DVI</th>
        <th>VGA</th>
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
                ':six'=> $terme,
                ':sept'=> $terme,
                ':huit'=> $terme,
                ':neuf'=> $terme
            ));
            $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

            foreach($trouver as $find)
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $find['id_ecran'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_num_serie'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_taille'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_HDMI'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_Displayport'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_DVI'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['ecran_VGA'] . "</td>";
                    echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Ecrans/?id=' . $find['id_ecran'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/ecran/delete/delete.php?id=' . $find['id_ecran'] . '">Supprimer</a></td>';
                    echo "</tr>";
                }
            }
        else
        {
            foreach($result as $ecran){
                
                if(isset($_GET['id']) && $ecran['id_ecran'] == $_GET['id'])
                {
                    echo '<td style=text-align:center; colspan="3"><form action="/api/ecran/update/update.php" method="POST">';
                    echo "ID n° " ;echo $ecran['id_ecran'] . ' ' .  $ecran['ecran_marque'] . ' ' .  $ecran['ecran_modele'] . ' ' .  $ecran['ecran_num_serie'];
                    ?><br><br><?php
                    echo '<input type="text" name="marque" value="' . $ecran['ecran_marque'] . '" placeholder="Marque">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="modele" value="' . $ecran['ecran_modele'] . '" placeholder="Modèle">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="serie" value="' . $ecran['ecran_num_serie'] . '" placeholder="N° de série">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="taille" value="' . $ecran['ecran_taille'] . '" placeholder="Taille">';
                    ?><br>
                    <br><?php
                    echo '<select name="HDMI" id="" >';?>
                    <option value="<?php echo $ecran['ecran_HDMI'];?>" selected><?php echo $ecran['ecran_HDMI'];?></option> <?php
                    ?><option value="">HDMI</option> <?php
                    ?><option value="Non">Non</option> <?php
                    ?><option value="Oui">Oui</option> <?php
                    echo '</select>';
                    ?><br><?php
                    echo '<select name="DP" id="" >';?>
                    <option value="<?php echo $ecran['ecran_Displayport'];?>" selected><?php echo $ecran['ecran_Displayport'];?></option> <?php
                    ?><option value="">Displayport</option> <?php
                    ?><option value="Non">Non</option> <?php
                    ?><option value="Oui">Oui</option> <?php
                    echo '</select>';
                    ?><br><?php
                    echo '<select name="DVI" id="" >';?>
                    <option value="<?php echo $ecran['ecran_DVI'];?>" selected><?php echo $ecran['ecran_DVI'];?></option> <?php
                    ?><option value="">DVI</option> <?php
                    ?><option value="Non">Non</option> <?php
                    ?><option value="Oui">Oui</option> <?php
                    echo '</select>';
                    ?><br><?php
                    echo '<select name="VGA" id="" >';?>
                    <option value="<?php echo $ecran['ecran_VGA'];?>" selected><?php echo $ecran['ecran_VGA'];?></option> <?php
                    ?><option value="">VGA</option> <?php
                    ?><option value="Non">Non</option> <?php
                    ?><option value="Oui">Oui</option> <?php
                    echo '</select>';
                    ?><br><?php
                    echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $ecran['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="ecran" value="' . $ecran['id_ecran'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $ecran['id_ecran'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_num_serie'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_taille'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_HDMI'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_Displayport'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_DVI'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['ecran_VGA'] . "</td>";
                    echo "<td style=text-align:center;>" . $ecran['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Ecrans/?id=' . $ecran['id_ecran'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/ecran/delete/delete.php?id=' . $ecran['id_ecran'] . '">Supprimer</a></td>';
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