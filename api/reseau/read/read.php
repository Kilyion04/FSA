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
$sql = "SELECT *
FROM prise_reseau";

$req = "SELECT *
FROM prise_reseau 
WHERE id_prise_reseau like :un OR
id_prise_reseau like :term OR
num_prise_reseau like :deux OR
connectique like :trois OR
id_bâtiment like :quatre OR
id_etage like :cinq OR
id_salle like :six OR
commentaire like :sept 
";

$rec = "SELECT *
FROM prise_reseau 
WHERE num_prise_reseau = :recherche";

// On prépare les requête
$query = $dbo->prepare($sql);

$requete = $dbo->prepare($req);

$rechercher = $dbo->prepare($rec);

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
                <th>N° prise réseau</th>
                <th>Connectique</th>
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
                            ':quatre'=> $terme,
                            ':cinq'=> $terme,
                            ':six'=> $terme,
                            ':sept'=> $terme
                        ));
                        $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                        foreach($trouver as $find)
                            {
                                echo "<tr>";
                                    echo "<td style=text-align:center;>" . $find['id_prise_reseau'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['num_prise_reseau'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['connectique'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['id_bâtiment'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['id_etage'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['id_salle'] . "</td>";
                                    echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                                    echo '<td style=text-align:center;><a href="/wordpress/Prises réseau/?id=' . $find['id_prise_reseau'] . '&nom='.$find['id_prise_reseau'].'">Modifier</a></td>';
                                    echo '<td style=text-align:center;><a href="/api/reseau/delete/delete.php?id=' . $find['id_prise_reseau'] . '">Supprimer</a></td>';
                                echo "</tr>";
                            }
                    }
                    elseif(isset($_GET['reseau']) && !empty($_GET['reseau'])) {
                        $id = $_GET['reseau'];
                        $rechercher->execute(array(
                            ':recherche'=> $id
                        ));
                        $un = $rechercher->fetchAll(PDO::FETCH_ASSOC);                         

                        foreach($un as $deux)
                            {
                                echo "<tr>";
                                    echo "<td style=text-align:center;>" . $deux['id_prise_reseau'] . "</td>";
                                    echo "<td style=text-align:center;>" . $deux['num_prise_reseau'] . "</td>";
                                    echo "<td style=text-align:center;>" . $deux['connectique'] . "</td>";
                                    echo "<td style=text-align:center;>" . $deux['id_bâtiment'] . "</td>";
                                    echo "<td style=text-align:center;>" . $deux['id_etage'] . "</td>";
                                    echo "<td style=text-align:center;>" . $deux['id_salle'] . "</td>";
                                    echo "<td style=text-align:center;>" . $deux['commentaire'] . "</td>";
                                    echo '<td style=text-align:center;><a href="/wordpress/Prises réseau/?id=' . $deux['id_prise_reseau'] . '&nom='.$deux['id_prise_reseau'].'">Modifier</a></td>';
                                    echo '<td style=text-align:center;><a href="/api/reseau/delete/delete.php?id=' . $deux['id_prise_reseau'] . '">Supprimer</a></td>';
                                echo "</tr>";
                            }
                    }
                    else
                    {
                        foreach($result as $reseau){
                            if(isset($_GET['id']) && $reseau['id_prise_reseau'] == $_GET['id'])
                            {
                                if(empty($reseau['bâtiment_nom']))
                                {$reseau['bâtiment_nom']=null;}
                                else{}

                                if(empty($reseau['etage_niveau']))
                                {$reseau['etage_niveau']= null;}
                                else{}

                                if(empty($reseau['salle_nom']))
                                {$reseau['salle_nom']= null;}

                                echo '<tr><td colspan="3"><form action="/api/reseau/update/update.php" method="POST">';
                                echo "ID n° " ;echo $reseau['id_prise_reseau'] . ' ' .  $reseau['num_prise_reseau'] . ' ' .  $reseau['connectique'];
                                ?><br>
                                <br><?php
                                echo '<input type="text" name="prise_reseau" value="' . $reseau['num_prise_reseau'] . '" placeholder="n° prise réseau" autocomplete="off">';
                                ?><br>
                                <br><?php
                                echo '<input type="text" name="connectique" value="' . $reseau['connectique'] . '" placeholder="connectique" autocomplete="off">';
                                
                                ?><br>
                                <br><?php

                                echo '<select name="batiment" id="" >';?>
                                <option value="<?php echo $result['bâtiment_nom'];?>" selected><?php echo $reseau['bâtiment_nom'];?></option> <?php
                                
                                foreach($bâtiment as $local1)
                                {
                                    ?><option value="<?php echo $local1['bâtiment_nom'];?>"><?php echo $local1['bâtiment_nom'];?></option> <?php
                                }
                                echo '</select>';
                                
                                ?><br>
                                <?php

                                echo '<select name="etage" id="" >';?>
                                <option value="<?php echo $result['etage_niveau'];?>" selected><?php echo $reseau['etage_niveau'];?></option> <?php
                                
                                foreach($etage as $local2)
                                {
                                    ?><option value="<?php echo $local2['etage_niveau'];?>"><?php echo $local2['etage_niveau'];?></option> <?php
                                }
                                echo '</select>';
                                
                                ?><br>
                                <?php

                                echo '<select name="salle" id="" >';?>
                                <option value="<?php echo $result['salle_nom'];?>" selected><?php echo $reseau['salle_nom'];?></option> <?php

                                foreach($salle as $local3)
                                {
                                    ?><option value="<?php echo $local3['salle_nom'];?>"><?php echo $local3['salle_nom'];?></option> <?php
                                }
                                echo '</select>';


                                ?><br>
                                <br><?php
                                
                                echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $reseau['commentaire'] . '</textarea>';
                                echo '<input type="submit" value="Modifier" name="modifier" >';
                                echo '<input type="hidden" name="reseau" value="' . $reseau['id_prise_reseau'] . '">';
                                echo "</form></td></tr>";
                                
                            }
                            else
                            {
                                echo "<tr>";
                                    echo "<td style=text-align:center;>" . $reseau['id_prise_reseau'] . "</td>";
                                    echo "<td style=text-align:center;>" . $reseau['num_prise_reseau'] . "</td>";
                                    echo "<td style=text-align:center;>" . $reseau['connectique'] . "</td>";
                                    echo "<td style=text-align:center;>" . $reseau['id_bâtiment'] . "</td>";
                                    echo "<td style=text-align:center;>" . $reseau['id_etage'] . "</td>";
                                    echo "<td style=text-align:center;>" . $reseau['id_salle'] . "</td>";
                                    echo "<td style=text-align:center;>" . $reseau['commentaire'] . "</td>";
                                    echo '<td style=text-align:center;><a href="/wordpress/prise reseau/?id=' . $reseau['id_prise_reseau'] . '">Modifier</a></td>';
                                    echo '<td style=text-align:center;><a href="/api/reseau/delete/delete.php?id=' . $reseau['id_prise_reseau'] . '">Supprimer</a></td>';
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