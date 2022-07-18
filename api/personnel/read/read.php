<?php

session_start();
require 'C:/xampp/htdocs/config.php';


$sal= $dbo->prepare("SELECT * from salle");
$sal->execute();
$salle= $sal->fetchALL();

$bat= $dbo->prepare("SELECT * from bâtiment");
$bat->execute();
$bâtiment= $bat->fetchALL();

$eta= $dbo->prepare("SELECT * from etage");
$eta->execute();
$etage= $eta->fetchALL();

// On écrit nos requêtes
$sql = "SELECT id_personnel, personnel_nom, personnel_prenom, personnel_statut,
personnel_statut, personnel.commentaire, personnel.id_bâtiment,
bâtiment.bâtiment_nom, personnel.id_etage, etage.etage_niveau ,
personnel.id_salle, salle.salle_nom
FROM personnel 
LEFT JOIN bâtiment ON personnel.id_bâtiment = bâtiment.bâtiment_nom 
LEFT JOIN etage ON personnel.id_etage = etage.etage_niveau
LEFT JOIN salle ON personnel.id_salle = salle.salle_nom
ORDER BY id_personnel
";

$req = "SELECT id_personnel, personnel_nom, personnel_prenom, personnel_statut, personnel_statut, personnel.commentaire, personnel.id_bâtiment, bâtiment.bâtiment_nom, personnel.id_etage, etage.etage_niveau , personnel.id_salle, salle.salle_nom
FROM personnel 
LEFT JOIN bâtiment ON personnel.id_bâtiment = bâtiment.bâtiment_nom 
LEFT JOIN etage ON personnel.id_etage = etage.etage_niveau
LEFT JOIN salle ON personnel.id_salle = salle.salle_nom 
WHERE id_personnel like :un OR
id_personnel like :term OR
personnel_nom like :deux OR
personnel_prenom like :trois OR
personnel_statut like :quatre 
";

$log = "SELECT * FROM personnel where id_personnel = :recherche";

// On prépare les requête
$query = $dbo->prepare($sql);

$requete = $dbo->prepare($req);

$request = $dbo->prepare($log);

// On exécute les requête
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
                <th>Nom</th>
                <th>Prénom</th>
                <th>Statut</th>
                <th>Bâtiment</th>
                <th>Étage</th>
                <th>Salle</th>
                <th>Commentaire</th>
            </div>
            <div>
                <?php    
                echo "<tbody>";
                    /* test si on effectue recherche dans la page*/
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
                            ':quatre'=> $terme
                        ));
                        $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                        foreach($trouver as $find)
                            {
                                echo "<tr>";
                                    echo "<td style=text-align:center;>" . $find['id_personnel'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['personnel_nom'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['personnel_prenom'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['personnel_statut'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['id_bâtiment'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['id_etage'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['id_salle'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                                    echo '<td style=text-align:center;><a href="/wordpress/personnel/?id=' . $find['id_personnel'] . '">Modifier</a></td>';
                                    echo '<td style=text-align:center;><a href="/api/personnel/delete/delete.php?id=' . $find['id_personnel'] . '">Supprimer</a></td>';
                                    echo '<td style=text-align:center;><a href="/wordpress/details/?id=' . $find['id_personnel'] . '">Détails</a></td>';
                                echo "</tr>";
                            }
                    }
                    elseif(isset($_GET['log']) && !empty($_GET['log']) )
                    {
                        $id = $_GET['log'];
                        $request->execute(array(
                            ':recherche'=> $id
                        ));
                        $deux = $request->fetchAll(PDO::FETCH_ASSOC);                         

                        foreach($deux as $trois)
                            {
                                echo "<tr>";
                                    echo "<td style=text-align:center;>" . $trois['id_personnel'] . "</td>";
                                    echo "<td style=text-align:center;>" . $trois['personnel_nom'] . "</td>";
                                    echo "<td style=text-align:center;>" . $trois['personnel_prenom'] . "</td>";
                                    echo "<td style=text-align:center;>" . $trois['personnel_statut'] . "</td>";
                                    echo "<td style=text-align:center;>" . $trois['id_bâtiment'] . "</td>";
                                    echo "<td style=text-align:center;>" . $trois['id_etage'] . "</td>";
                                    echo "<td style=text-align:center;>" . $trois['id_salle'] . "</td>";
                                    echo "<td style=text-align:center;>" . $trois['commentaire'] . "</td>";
                                    echo '<td style=text-align:center;><a href="/wordpress/personnel/?id=' . $trois['id_personnel'] . '">Modifier</a></td>';
                                    echo '<td style=text-align:center;><a href="/api/personnel/delete/delete.php?id=' . $trois['id_personnel'] . '">Supprimer</a></td>';
                                    echo '<td style=text-align:center;><a href="/wordpress/details/?id=' . $trois['id_personnel'] . '">Détails</a></td>';
                                echo "</tr>";
                            }
                    }
                    else
                    {
                        foreach($result as $personnel)
                        {
                            if(isset($_GET['id']) && $personnel['id_personnel'] == $_GET['id']){                      
                                echo '<td style=text-align:center; colspan="3"><form action="/api/personnel/update/update.php" method="POST">';
                                echo "ID n° " ;echo $personnel['id_personnel'] . ' ' .  $personnel['personnel_nom'] . ' ' .  $personnel['personnel_prenom'] . ' ' .  $personnel['personnel_statut'];
                                ?><br>
                                <br><?php
                                echo '<input type="text" name="name" value="' . $personnel['personnel_nom'] . '" placeholder="Nom" autocomplete="off">';
                                ?><br>
                                <br><?php
                                echo '<input type="text" name="prenom" value="' . $personnel['personnel_prenom'] . '" placeholder="Prenom" autocomplete="off">';
                                ?><br>
                                <br><?php
                                echo '<input type="text" name="statut" value="' . $personnel['personnel_statut'] . '" placeholder="Statut" autocomplete="off">';
                                
                                ?><br>
                                <br><?php

                                echo '<select name="batiment" id="" >';?>
                                <option value="<?php echo $personnel['bâtiment_nom'];?>" selected><?php echo $personnel['bâtiment_nom'];?></option> <?php
                                
                                foreach($bâtiment as $local1)
                                {
                                    ?><option value="<?php echo $local1['bâtiment_nom'];?>"><?php echo $local1['bâtiment_nom'];?></option> <?php
                                }
                                echo '</select>';
                                
                                ?><br>
                                <?php

                                echo '<select name="etage" id="" >';?>
                                <option value="<?php echo $personnel['etage_niveau'];?>" selected><?php echo $personnel['etage_niveau'];?></option> <?php
                                
                                foreach($etage as $local2)
                                {
                                    ?><option value="<?php echo $local2['etage_niveau'];?>"><?php echo $local2['etage_niveau'];?></option> <?php
                                }
                                echo '</select>';
                                
                                ?><br>
                                <?php

                                echo '<select name="salle" id="" >';?>
                                <option value="<?php echo $personnel['salle_nom'];?>" selected><?php echo $personnel['salle_nom'];?></option> <?php

                                foreach($salle as $local3)
                                {
                                    ?><option value="<?php echo $local3['salle_nom'];?>"><?php echo $local3['salle_nom'];?></option> <?php
                                }
                                echo '</select>';


                                ?><br>
                                <br><?php
                    
                                echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $personnel['commentaire'] . '</textarea>';
                                echo '<input type="submit" value="Modifier" name="modifier" >';
                                echo '<input type="hidden" name="personnel" value="' . $personnel['id_personnel'] . '">';
                                echo "</form></td>";
                            }
                            else{
                                echo "<tr>";
                                    echo "<td style=text-align:center;>" . $personnel['id_personnel'] . "</td>";
                                    echo "<td style=text-align:center;>" . $personnel['personnel_nom'] . "</td>";
                                    echo "<td style=text-align:center;>" . $personnel['personnel_prenom'] . "</td>";
                                    echo "<td style=text-align:center;>" . $personnel['personnel_statut'] . "</td>";
                                    echo "<td style=text-align:center;>" . $personnel['id_bâtiment'] . "</td>";
                                    echo "<td style=text-align:center;>" . $personnel['id_etage'] . "</td>";
                                    echo "<td style=text-align:center;>" . $personnel['id_salle'] . "</td>";
                                    echo "<td style=text-align:center;>" . $personnel['commentaire'] . "</td>";
                                    echo '<td style=text-align:center;><a href="/wordpress/personnel/?id=' . $personnel['id_personnel'] . '">Modifier</a></td>';
                                    echo '<td style=text-align:center;><a href="/api/personnel/delete/delete.php?id=' . $personnel['id_personnel'] . '">Supprimer</a></td>';
                                    echo '<td style=text-align:center;><a href="/wordpress/details/?id=' . $personnel['id_personnel'] . '">Détails</a></td>';
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

<?php

?>