<?php

session_start();
require 'C:/xampp/htdocs/config.php';



// On écrit notre requête
$sql = "SELECT * FROM cartouche ";

$req = "SELECT * FROM cartouche
WHERE id_cartouche like :un OR
id_cartouche like :term OR
cartouche_marque like :deux OR
cartouche_quantite like :trois OR
cartouche_modele like :quatre OR
commentaire like :cinq
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
        <th>Quantite</th>
        <th>Modèle</th>
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
                    ':cinq'=> $terme
                ));
                $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                foreach($trouver as $find)
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $find['id_cartouche'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['cartouche_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['cartouche_quantite'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['cartouche_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Cartouches/?id=' . $find['id_cartouche'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/cartouche/delete/delete.php?id=' . $find['id_cartouche'] . '">Supprimer</a></td>';
                        echo "</tr>";
                    }
            }
        else
        {
            foreach($result as $cartouche){
                
                if(isset($_GET['id']) && $cartouche['id_cartouche'] == $_GET['id'])
                {
                    echo '<td colspan="3"><form action="/api/cartouche/update/update.php" method="POST">';
                    echo "ID n° " ;echo $cartouche['id_cartouche'] . ' ' .  $cartouche['cartouche_marque'] . ' ' .  $cartouche['cartouche_modele'];
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="marque" value="' . $cartouche['cartouche_marque'] . '" placeholder="Marque" autocomplete="off">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="quantite" value="' . $cartouche['cartouche_quantite'] . '" placeholder="Nombre de cartouche" autocomplete="off">';
                    ?><br><br>
                    <br><?php
                    echo '<input type="text" name="modele" value="' . $cartouche['cartouche_modele'] . '" placeholder="Modèle" autocomplete="off">';
                    ?><br>
                    <br><?php
                    echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $cartouche['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="cartouche" value="' . $cartouche['id_cartouche'] . '">';
                    echo "</form></td>";
                    
                }

                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $cartouche['id_cartouche'] . "</td>";
                    echo "<td style=text-align:center;>" . $cartouche['cartouche_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $cartouche['cartouche_quantite'] . "</td>";
                    echo "<td style=text-align:center;>" . $cartouche['cartouche_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $cartouche['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Cartouches/?id=' . $cartouche['id_cartouche'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/cartouche/delete/delete.php?id=' . $cartouche['id_cartouche'] . '">Supprimer</a></td>';
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