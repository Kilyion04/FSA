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

// On écrit notre requête
$sql = "SELECT appareil_mesure.*, bâtiment.bâtiment_nom, etage, etage.etage_niveau , salle, salle.salle_nom, appareil_mesure.commentaire
FROM appareil_mesure
LEFT JOIN bâtiment ON appareil_mesure.bâtiment = bâtiment.bâtiment_nom 
LEFT JOIN etage ON appareil_mesure.etage = etage.etage_niveau
LEFT JOIN salle ON appareil_mesure.salle = salle.salle_nom ";

$req = "SELECT id_appareil, appareil_marque, appareil_type, appareil_modele, appareil_adresse_mac,
appareil_adresse_ip, prise_reseau, bâtiment, etage, salle,
bâtiment.bâtiment_nom, etage, etage.etage_niveau , salle, salle.salle_nom, appareil_mesure.commentaire
FROM appareil_mesure
LEFT JOIN bâtiment ON appareil_mesure.bâtiment = bâtiment.bâtiment_nom 
LEFT JOIN etage ON appareil_mesure.etage = etage.etage_niveau
LEFT JOIN salle ON appareil_mesure.salle = salle.salle_nom 
WHERE id_appareil like :un OR
id_appareil like :term OR
appareil_marque like :deux OR
appareil_type like :trois OR
appareil_modele like :quatre OR
appareil_adresse_mac like :cinq OR
appareil_adresse_ip like :six OR
prise_reseau like :sept OR
bâtiment like :huit OR
etage like :neuf OR
salle like :dix OR
appareil_mesure.commentaire like :onze
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    </head>
    <body>
        
        <div>
            
        <div>
        <th>ID</th>
        <th>Marque</th>
        <th>Type</th>
        <th>Modèle</th>
        <th>Adresse MAC</th>
        <th>Adresse IP</th>
        <th>Prise réseau</th>
        <th>Bâtiment</th>
        <th>Étage</th>
        <th>Salle</th>
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
                    ':neuf'=> $terme,
                    ':dix'=> $terme,
                    ':onze'=> $terme
                ));
                $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                foreach($trouver as $find)
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $find['id_appareil'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['appareil_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['appareil_type'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['appareil_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['appareil_adresse_mac'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['appareil_adresse_ip'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['prise_reseau'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['bâtiment'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['etage'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['salle'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Appareils de mesure/?id=' . $find['id_appareil'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/appareil/delete/delete.php?id=' . $find['id_appareil'] . '">Supprimer</a></td>';
                        echo "</tr>";
                    }
            }
            else
            {
                foreach($result as $appareil){
                    
                    if(isset($_GET['id']) && $appareil['id_appareil']==($_GET['id']))
                    {
                        echo '<td colspan="3"><form action="/api/appareil/update/update.php" method="POST">';
                        echo "ID n° " ;echo $appareil['id_appareil'] . ' ' .  $appareil['appareil_marque'] . ' ' .  $appareil['appareil_type'] . ' ' .  $appareil['appareil_modele'];
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="marque" value="' . $appareil['appareil_marque'] . '" placeholder="marque" autocomplete="off">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="type" value="' . $appareil['appareil_type'] . '" placeholder="type" autocomplete="off">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="modele" value="' . $appareil['appareil_modele'] . '" placeholder="modèle" autocomplete="off">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="mac" value="' . $appareil['appareil_adresse_mac'] . '" placeholder="adresse IP">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="ip" value="' . $appareil['appareil_adresse_ip'] . '" placeholder="adresse MAC">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="reseau" value="' . $appareil['prise_reseau'] . '" placeholder="Numéro réseau" autocomplete="off">';
                        
                        ?><br>
                        <br><?php

                        echo '<select name="batiment" id="" >';?>
                        <option value="<?php echo $result['bâtiment'];?>" selected><?php echo $appareil['bâtiment'];?></option> <?php
                        
                        foreach($bâtiment as $local1)
                        {
                            ?><option value="<?php echo $local1['bâtiment_nom'];?>"><?php echo $local1['bâtiment_nom'];?></option> <?php
                        }
                        echo '</select>';
                        
                        ?><br>
                        <?php

                        echo '<select name="etage" id="" >';?>
                        <option value="<?php echo $result['etage'];?>" selected><?php echo $appareil['etage'];?></option> <?php
                        
                        foreach($etage as $local2)
                        {
                            ?><option value="<?php echo $local2['etage_niveau'];?>"><?php echo $local2['etage_niveau'];?></option> <?php
                        }
                        echo '</select>';
                        
                        ?><br>
                        <?php

                        echo '<select name="salle" id="" >';?>
                        <option value="<?php echo $result['salle'];?>" selected><?php echo $appareil['salle'];?></option> <?php

                        foreach($salle as $local3)
                        {
                            ?><option value="<?php echo $local3['salle_nom'];?>"><?php echo $local3['salle_nom'];?></option> <?php
                        }
                        echo '</select>';


                        ?><br>
                        <br><?php
                        
                        echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $appareil['commentaire'] . '</textarea>';
                        echo '<input type="submit" value="Modifier" name="modifier" >';
                        echo '<input type="hidden" name="appareil" value="' . $appareil['id_appareil'] . '">';
                        echo "</form></td>";                        
                        
                    }

                    else
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $appareil['id_appareil'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['appareil_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['appareil_type'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['appareil_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['appareil_adresse_mac'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['appareil_adresse_ip'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['prise_reseau'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['bâtiment_nom'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['etage_niveau'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['salle'] . "</td>";
                        echo "<td style=text-align:center;>" . $appareil['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Appareils de mesure/?id=' . $appareil['id_appareil'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/appareil/delete/delete.php?id=' . $appareil['id_appareil'] . '">Supprimer</a></td>';
                        echo "</tr>";
                    }
                }
            }
            echo "</tbody>";
            ?>
        </div>
        </div>
        <script>
        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        });
        </script>   
    </body>
</html>