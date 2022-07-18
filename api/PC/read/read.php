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
$sql = "SELECT id_pc,
pc_date_acquisition,
pc_marque,
pc_modele,
pc_num_serie,
pc_num_inventaire_artois,
pc_nom_machine,
pc_adresse_mac,
pc_adresse_ip,
pc_prise_reseau,
pc_systeme_exploitation,
pc_memoire_RAM,
pc_taille_disque_1,
pc_taille_disque_2,
pc_type,
pc_appartenance,
pc.id_bâtiment,
pc.id_etage,
pc.id_salle,
pc.commentaire
FROM pc 
";

// On prépare la requête
$query = $dbo->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div>
    <div>
        <th>ID</th>
        <th>Date d'acquisition</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>N° de série</th>
        <th>N° d'inventaire Artois</th>
        <th>Nom</th>
        <th>Adresse MAC</th>
        <th>Adresse IP</th>
        <th>Prise réseau</th>
        <th>Système d'exploitation</th>
        <th>Mémoire RAM</th>
        <th>Mémoire disque N°1</th>
        <th>Mémoire disque N°2</th>
        <th>Type</th>
        <th>Appartenance</th>
        <th>Bâtiment</th>
        <th>Etage</th>
        <th>Salle</th>
        <th>Commentaire</th>
    </div>
    <div>
        <?php
        echo "<tbody>";
            foreach($result as $pc){
                
                if(isset($_GET['id']) && $pc['id_pc'] == $_GET['id'])
                {
                    echo '<td style=text-align:center; colspan="3"><form action="/api/PC/update/update.php/?ip=' . $pc['pc_adresse_ip'] . '" method="POST">';
                    echo "ID n° " ;echo $pc['id_pc'] . ' ' .  $pc['pc_marque'] . ' ' .  $pc['pc_modele'] . ' ' .  $pc['pc_nom_machine'];
                    ?><br>
                    <br><?php
                    echo '<input type="date" name="date" value="' . $pc['pc_date_acquisition'] . '" placeholder="Date d\'acquisition">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="marque" value="' . $pc['pc_marque'] . '" placeholder="Marque">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="modele" value="' . $pc['pc_modele'] . '" placeholder="Modèle">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="serie" value="' . $pc['pc_num_serie'] . '" placeholder="N° de série">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="artois" value="' . $pc['pc_num_inventaire_artois'] . '" placeholder="N° inventaire">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="machine" value="' . $pc['pc_nom_machine'] . '" placeholder="Nom de la machine">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="MAC" value="' . $pc['pc_adresse_mac'] . '" placeholder="Adresse MAC">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="IP" value="' . $pc['pc_adresse_ip'] . '" placeholder="Adresse IP">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="reseau" value="' . $pc['pc_prise_reseau'] . '" placeholder="Prise réseau">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="systeme" value="' . $pc['pc_systeme_exploitation'] . '" placeholder="Système d\'exploitation">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="RAM" value="' . $pc['pc_memoire_RAM'] . '" placeholder="Mémoire RAM">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="un" value="' . $pc['pc_taille_disque_1'] . '" placeholder="Capacité en Go">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="deux" value="' . $pc['pc_taille_disque_2'] . '" placeholder="Capacité en Go">';
                    ?><br>
                    <br><?php
                    echo '<input type="text" name="ordi" value="' . $pc['pc_type'] . '" placeholder="Type d\'ordinateur">';
                    ?><br>
                    <br><?php
                    echo '<select name="appartenance" id="" >';?>
                    <option value="<?php echo $pc['pc_appartenance'];?>" selected><?php echo $pc['pc_appartenance'];?></option> <?php
                    ?><option value="personnel">personnel</option><?php
                    ?><option value="entreprise">entreprise</option><?php
                    ?><option value="université">université</option><?php
                    ?><option value=""></option><?php
                    echo '</select>';
                    ?><br>
                    <br><?php

                    echo '<select name="batiment" id="" >';?>
                    <option value="<?php echo $pc['id_bâtiment'];?>" selected><?php echo $pc['id_bâtiment'];?></option> <?php
                    
                    foreach($bâtiment as $local1)
                    {
                        ?><option value="<?php echo $local1['bâtiment_nom'];?>"><?php echo $local1['bâtiment_nom'];?></option> <?php
                    }
                    echo '</select>';
                    
                    ?><br>
                    <?php

                    echo '<select name="etage" id="" >';?>
                    <option value="<?php echo $pc['id_etage'];?>" selected><?php echo $pc['id_etage'];?></option> <?php
                    
                    foreach($etage as $local2)
                    {
                        ?><option value="<?php echo $local2['etage_niveau'];?>"><?php echo $local2['etage_niveau'];?></option> <?php
                    }
                    echo '</select>';
                    
                    ?><br>
                    <?php

                    echo '<select name="salle" id="" >';?>
                    <option value="<?php echo $pc['id_salle'];?>" selected><?php echo $pc['id_salle'];?></option> <?php

                    foreach($salle as $local3)
                    {
                        ?><option value="<?php echo $local3['salle_nom'];?>"><?php echo $local3['salle_nom'];?></option> <?php
                    }
                    echo '</select>';


                    ?><br>
                    <br><?php
                    
                    echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $pc['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="pc" value="' . $pc['id_pc'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $pc['id_pc'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_date_acquisition'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_marque'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_modele'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_num_serie'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_num_inventaire_artois'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_nom_machine'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_adresse_mac'] . "</td>";
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/IP/?ip='. $pc['pc_adresse_ip'] . '">' . $pc['pc_adresse_ip'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/prise-reseau/?réseau='. $pc["pc_prise_reseau"] . '">' . $pc["pc_prise_reseau"] . '</a></td>';
                    echo "<td style=text-align:center;>" . $pc['pc_systeme_exploitation'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_memoire_RAM'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_taille_disque_1'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_taille_disque_2'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_type'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['pc_appartenance'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['id_bâtiment'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['id_etage'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['id_salle'] . "</td>";
                    echo "<td style=text-align:center;>" . $pc['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/pc/?id=' . $pc['id_pc'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/pc/delete/delete.php?id=' . $pc['id_pc'] . '&ip=' . $pc['pc_adresse_ip'] . '&reseau=' . $pc['pc_prise_reseau'] . '">Supprimer</a></td>';
                    echo "</tr>";
                }
            }  
        echo "</tbody>";
        
        ?>
    </div>
</div>
<?php

?>