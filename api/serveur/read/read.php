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
$sql = "SELECT
id_serveur,
serveur_marque,
serveur_modele,
serveur_num_serie,
serveur_num_inventaire_artois,
serveur_adresse_mac,
serveur_adresse_ip,
serveur_prise_reseau,
serveur_systeme_exploitation,
serveur_memoire_RAM,
serveur_taille_disque_1,
serveur_taille_disque_2,
id_bâtiment,
id_etage,
id_salle,
commentaire
FROM serveur
";

$req = "SELECT
id_serveur, serveur_marque, serveur_modele, serveur_num_serie, serveur_num_inventaire_artois,
serveur_adresse_mac, serveur_adresse_ip, serveur_prise_reseau, serveur_systeme_exploitation,
serveur_memoire_RAM, serveur_taille_disque_1, serveur_taille_disque_2, id_bâtiment,
id_etage, id_salle, commentaire
FROM serveur
WHERE id_serveur like :un OR
id_serveur like :term OR
serveur_marque like :deux OR
serveur_modele like :trois OR
serveur_num_serie like :quatre OR
serveur_num_inventaire_artois like :cinq OR
serveur_adresse_mac like :six OR
serveur_adresse_ip like :sept OR
serveur_prise_reseau like :huit OR
serveur_systeme_exploitation like :neuf OR
serveur_memoire_RAM like :dix OR
serveur_taille_disque_1 like :onze OR
serveur_taille_disque_2 like :douze OR
commentaire like :treize
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
            <th>ID</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>N° de série</th>
            <th>N° inventaire Artois</th>
            <th>Adresse MAC</th>
            <th>Adresse IP</th>
            <th>Prise réseau</th>
            <th>Système d'exploitation</th>
            <th>Mémoire RAM</th>
            <th>Taille disque 1</th>
            <th>Taille disque 2</th>
            <th>Bâtiment</th>
            <th>Etage</th>
            <th>Salle</th>
            <th>Commentaire</th>
        </div>
        <div>
        <?php
        echo "<tbody>";
            if(isset($_GET['nom']) && !empty($_GET['nom']))
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
                    ':onze'=> $terme,
                    ':douze'=> $terme,
                    ':treize'=> $terme
                ));
                $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);
                foreach($trouver as $find)
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $find['id_serveur'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_num_serie'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_num_inventaire_artois'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_adresse_mac'] . "</td>";
                        echo "<td style=text-align:center;><a href='http://localhost/wordpress/ip/?id='>" . $find['serveur_adresse_ip'] . "</a></td>";
                        echo "<td style=text-align:center;><a href='http://localhost/wordpress/reseau/?id='>" . $find['serveur_prise_reseau'] . "</a></td>";
                        echo "<td style=text-align:center;>" . $find['serveur_systeme_exploitation'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_memoire_RAM'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_taille_disque_1'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['serveur_taille_disque_2'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['id_bâtiment'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['id_etage'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['id_salle'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Serveurs/?id=' . $find['id_serveur'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/serveur/delete/delete.php?id=' . $find['id_serveur'] . '">Supprimer</a></td>';
                        echo "</tr>";
                    }
            }
            else
            {
                foreach($result as $serveur){
                    
                    if(isset($_GET['id']) && $serveur['id_serveur'] == $_GET['id'])
                    {
                        echo '<td style=text-align:center; colspan="3"><form action="/api/serveur/update/update.php" method="POST">';
                        echo "ID n° " ;echo $serveur['id_serveur'] . ' ' .  $serveur['serveur_marque'] . ' ' .  $serveur['serveur_modele'] . ' ' .  $serveur['serveur_num_serie'];
                        ?><br><br><?php
                        echo '<input type="text" name="marque" value="' . $serveur['serveur_marque'] . '" placeholder="Marque">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="modele" value="' . $serveur['serveur_modele'] . '" placeholder="Modèle">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="serie" value="' . $serveur['serveur_num_serie'] . '" placeholder="N° de série">';
                        ?><br>
                        <br><?php
                        echo '<input type="number" name="artois" value="' . $serveur['serveur_num_inventaire_artois'] . '" placeholder="N° d inventaire artois">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="MAC" value="' . $serveur['serveur_adresse_mac'] . '" placeholder="Adresse MAC">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="IP" value="' . $serveur['serveur_adresse_ip'] . '" placeholder="Adresse IP">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="reseau" value="' . $serveur['serveur_prise_reseau'] . '" placeholder="Prise réseau">';
                        ?><br>
                        <br><?php
                        echo '<input type="text" name="systeme" value="' . $serveur['serveur_systeme_exploitation'] . '" placeholder="Système dexploitation">';
                        ?><br>
                        <br><?php
                        echo '<input type="number" name="RAM" value="' . $serveur['serveur_memoire_RAM'] . '" placeholder="Mémoire RAM">';
                        ?><br>
                        <br><?php
                        echo '<input type="number" name="un" value="' . $serveur['serveur_taille_disque_1'] . '" placeholder="Disque N°1">';
                        ?><br>
                        <br><?php
                        echo '<input type="number" name="deux" value="' . $serveur['serveur_taille_disque_2'] . '" placeholder="Disque N°2">';
                        
                        ?><br>
                        <br><?php

                        echo '<select name="batiment" id="" >';?>
                        <option value="<?php echo $serveur['id_bâtiment'];?>" selected><?php echo $serveur['id_bâtiment'];?></option> <?php
                        
                        foreach($bâtiment as $local1)
                        {
                            ?><option value="<?php echo $local1['bâtiment_nom'];?>"><?php echo $local1['bâtiment_nom'];?></option> <?php
                        }
                        echo '</select>';
                        
                        ?><br>
                        <?php

                        echo '<select name="etage" id="" >';?>
                        <option value="<?php echo $serveur['id_etage'];?>" selected><?php echo $serveur['id_etage'];?></option> <?php
                        
                        foreach($etage as $local2)
                        {
                            ?><option value="<?php echo $local2['etage_niveau'];?>"><?php echo $local2['etage_niveau'];?></option> <?php
                        }
                        echo '</select>';
                        
                        ?><br>
                        <?php

                        echo '<select name="salle" id="" >';?>
                        <option value="<?php echo $serveur['id_salle'];?>" selected><?php echo $serveur['id_salle'];?></option> <?php

                        foreach($salle as $local3)
                        {
                            ?><option value="<?php echo $local3['salle_nom'];?>"><?php echo $local3['salle_nom'];?></option> <?php
                        }
                        echo '</select>';


                        ?><br>
                        <br><?php
                        
                        echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $serveur['commentaire'] . '</textarea>';
                        echo '<input type="submit" value="Modifier" name="modifier" >';
                        echo '<input type="hidden" name="serveur" value="' . $serveur['id_serveur'] . '">';
                        echo "</form></td>";
                        
                    }
                    else
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $serveur['id_serveur'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_num_serie'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_num_inventaire_artois'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_adresse_mac'] . "</td>";
                        echo '<td style=text-align:center;><a href="http://localhost/wordpress/IP/?ip='. $serveur['serveur_adresse_ip'] . '">' . $serveur['serveur_adresse_ip'] . '</a></td>';
                        echo '<td style=text-align:center;><a href="http://localhost/wordpress/Prises réseau/?reseau='. $serveur['serveur_prise_reseau'] . '">' . $serveur['serveur_prise_reseau'] . '</a></td>';
                        echo "<td style=text-align:center;>" . $serveur['serveur_systeme_exploitation'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_memoire_RAM'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_taille_disque_1'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['serveur_taille_disque_2'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['id_bâtiment'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['id_etage'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['id_salle'] . "</td>";
                        echo "<td style=text-align:center;>" . $serveur['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Serveurs/?id=' . $serveur['id_serveur'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/serveur/delete/delete.php?id=' . $serveur['id_serveur'] . '">Supprimer</a></td>';
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