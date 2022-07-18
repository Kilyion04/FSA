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
$sql = "SELECT * FROM imprimante ";

$req = "SELECT * FROM imprimante 
WHERE id_imprimante LIKE :un OR
id_imprimante LIKE :term OR
imprimante_marque LIKE :deux OR
imprimante_modele LIKE :trois OR
imprimante_num_serie LIKE :quatre OR
num_inventaire_artois LIKE :cinq OR
imprimante_adresse_mac LIKE :six OR
imprimante_adresse_ip LIKE :sept OR
id_prise_reseau LIKE :huit OR
id_imprimer LIKE :neuf OR
imprimante.id_bâtiment LIKE :dix OR
imprimante.id_etage LIKE :onze OR
imprimante.id_salle LIKE :douze OR
imprimante.commentaire LIKE :treize 
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
        <meta charset="UTF-huit">
        <meta name="viewport" content="width=device-width, initial-scale=un.0">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/un.douze.un/themes/start/jquery-ui.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/un.neuf.un/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/un.onze.quatre/jquery-ui.min.js"></script>
    </head>
    <body>
        
        <div>
            
        <div>
        <th>ID</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>N° de série</th>
        <th>N° Artois</th>
        <th>Adresse MAC</th>
        <th>Adresse IP</th>
        <th>Prise réseau</th>
        <th>Profil d'mpression</th>
        <th>Partage</th>
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
                    ':onze'=> $terme,
                    ':douze'=> $terme,
                    ':treize'=> $terme
                ));
                $trouver = $requete->fetchAll(PDO::FETCH_ASSOC);                         

                foreach($trouver as $find)
                    {
                        echo "<tr>";
                        echo "<td style=text-align:center;>" . $find['id_imprimante'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['imprimante_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['imprimante_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['imprimante_num_serie'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['num_inventaire_artois'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['imprimante_adresse_mac'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['imprimante_adresse_ip'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['id_prise_reseau'] . "</td>";
                        echo "<td style=text-align:center;><a href='http://localhost/wordpress/imprimer/?id='>" . $find['id_imprimer'] . "</a></td>";
                        echo "<td style=text-align:center;>" . $find['partage'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['id_bâtiment'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['id_etage'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['id_salle'] . "</td>";
                        echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Imprimantes/?id=' . $find['id_imprimante'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/imprimante/delete/delete.php?id=' . $find['id_imprimante'] . '">Supprimer</a></td>';
                    echo "</tr>";
                    }
            }
        else
        {
            foreach($result as $imprimante){
                
                if(isset($_GET['id']) && $imprimante['id_imprimante'] == $_GET['id'])
                {
                    echo '<td style=text-align:center; colspan="trois"><form action="/api/imprimante/update/update.php" method="POST">';
                    echo "ID n° " ;echo $imprimante['id_imprimante'] . ' ' .  $imprimante['imprimante_marque'] . ' ' .  $imprimante['imprimante_modele'] . ' ' .  $imprimante['imprimante_num_serie'];
                    ?><br><br><?php
                    echo '<input type="text" name="marque" value="' . $imprimante['imprimante_marque'] . '" placeholder="marque">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="modele" value="' . $imprimante['imprimante_modele'] . '" placeholder="modèle">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="serie" value="' . $imprimante['imprimante_num_serie'] . '" placeholder="numéro de série">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="artois" value="' . $imprimante['num_inventaire_artois'] . '" placeholder="numéro artois">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="mac" value="' . $imprimante['imprimante_adresse_mac'] . '" placeholder="adresse mac">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="ip" value="' . $imprimante['imprimante_adresse_ip'] . '" placeholder="adresse ip">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="reseau" value="' . $imprimante['id_prise_reseau'] . '" placeholder="prise réseau">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="imprimer" value="' . $imprimante['id_imprimer'] . '" placeholder="Profil d\'impression">';
                    ?><br>
                    <br><?php
                    echo '<select name="partage" id="" >';?>
                    <option value="<?php echo $imprimante['partage'];?>" selected><?php echo $imprimante['partage'];?></option> <?php
                    ?><option value=""></option> <?php
                    ?><option value="Oui">Oui</option> <?php
                    ?><option value="Non">Non</option> <?php
                    echo '</select>';
                    
                    ?><br>
                    <?php
                    echo '<select name="batiment" id="" >';?>
                    <option value="<?php echo $imprimante['id_bâtiment'];?>" selected><?php echo $imprimante['id_bâtiment'];?></option> <?php
                    
                    foreach($bâtiment as $local1)
                    {
                        ?><option value="<?php echo $local1['bâtiment_nom'];?>"><?php echo $local1['bâtiment_nom'];?></option> <?php
                    }
                    echo '</select>';
                    
                    ?><br>
                    <?php

                    echo '<select name="etage" id="" >';?>
                    <option value="<?php echo $imprimante['id_etage'];?>" selected><?php echo $imprimante['id_etage'];?></option> <?php
                    
                    foreach($etage as $local2)
                    {
                        ?><option value="<?php echo $local2['etage_niveau'];?>"><?php echo $local2['etage_niveau'];?></option> <?php
                    }
                    echo '</select>';
                    
                    ?><br>
                    <?php

                    echo '<select name="salle" id="" >';?>
                    <option value="<?php echo $imprimante['id_salle'];?>" selected><?php echo $imprimante['id_salle'];?></option> <?php

                    foreach($salle as $local3)
                    {
                        ?><option value="<?php echo $local3['salle_nom'];?>"><?php echo $local3['salle_nom'];?></option> <?php
                    }
                    echo '</select>';


                    ?><br>
                    <br><?php
                    echo '<textarea name="commentaire"  cols="cinq0" rows="cinq"  placeholder="Commentaire">' . $imprimante['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="imprimante" value="' . $imprimante['id_imprimante'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                        echo "<td style=text-align:center;>" . $imprimante['id_imprimante'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['imprimante_marque'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['imprimante_modele'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['imprimante_num_serie'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['num_inventaire_artois'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['imprimante_adresse_mac'] . "</td>";
                        echo '<td style=text-align:center;><a href="http://localhost/wordpress/IP/?ip='. $imprimante['imprimante_adresse_ip'] . '">' . $imprimante['imprimante_adresse_ip'] . '</a></td>';
                        echo '<td style=text-align:center;><a href="http://localhost/wordpress/prise-reseau/?reseau='. $imprimante["id_prise_reseau"] . '">' . $imprimante["id_prise_reseau"] . '</a></td>';
                        echo "<td style=text-align:center;><a href='http://localhost/wordpress/imprimer/?id='>" . $imprimante['id_imprimer'] . "</a></td>";
                        echo "<td style=text-align:center;>" . $imprimante['partage'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['id_bâtiment'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['id_etage'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['id_salle'] . "</td>";
                        echo "<td style=text-align:center;>" . $imprimante['commentaire'] . "</td>";
                        echo '<td style=text-align:center;><a href="/wordpress/Imprimantes/?id=' . $imprimante['id_imprimante'] . '">Modifier</a></td>';
                        echo '<td style=text-align:center;><a href="/api/imprimante/delete/delete.php?id=' . $imprimante['id_imprimante'] . '">Supprimer</a></td>';
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

            $( "#tun" ).autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "autocomplete-sourcedeux.php",
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
            $("#tun").val(ui.item.label); // uncomment if you want to display name in place of id

            $("#dun").load("autocomplete-record.php?id="+ui.item.value);
            },
            focus: function(event, ui) {
                    event.preventDefault();
                    $("#tun").val(ui.item.label);
                }
            });

            //////
            })
        </script> 
    </body>
</html>