<?php

session_start();
require 'C:/xampp/htdocs/config.php';



// On écrit notre requête
$sql = "SELECT * from logiciel";

$req = "SELECT * from logiciel
WHERE id_logiciel like :terme OR
id_logiciel like :un OR
logiciel_editeur like :deux OR
logiciel_nom like :trois OR
logiciel_version like :quatre OR
logiciel_type like :cinq 
";

$log = "SELECT * from logiciel WHERE id_logiciel = :recherche";

// On prépare la requête
$query = $dbo->prepare($sql);

$requete = $dbo->prepare($req);

$request = $dbo->prepare($log);

// On exécute la requête
$query->execute();

$requete->execute();

$request->execute();

// On stocke le résultat dans un divau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div>
    <div>
        <th>ID</th>
        <th>Editeur</th>
        <th>Nom</th>
        <th>Version</th>
        <th>Officiel</th>
        <th>Type</th>
        <th>Commentaire</th>
    </div>
    <div>
        <?php
        echo "<tbody>";
            if(isset($_GET['nom'])  && !empty($_GET['nom']) )
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
                            echo "<td style=text-align:center;>" . $find['id_logiciel'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['logiciel_editeur'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['logiciel_nom'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['logiciel_version'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['logiciel_off'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['logiciel_type'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                            echo '<td style=text-align:center;><a href="/wordpress/Logiciels/?id=' . $find['id_logiciel'] . '">Modifier</a></td>';
                            echo '<td style=text-align:center;><a href="/api/logiciel/delete/delete.php?id=' . $find['id_logiciel'] . '">Supprimer</a></td>';
                            echo "</tr>";
                        }
                }
            elseif(isset($_GET['log'])  && !empty($_GET['log']) )
                {
                    $id = $_GET['log'];
                    $request->execute(array(
                        ':recherche'=> $id
                    ));
                    $find = $request->fetchAll(PDO::FETCH_ASSOC);                         

                    foreach($find as $trouver)
                        {
                            echo "<tr>";
                            echo "<td style=text-align:center;>" . $trouver['id_logiciel'] . "</td>";
                            echo "<td style=text-align:center;>" . $trouver['logiciel_editeur'] . "</td>";
                            echo "<td style=text-align:center;>" . $trouver['logiciel_nom'] . "</td>";
                            echo "<td style=text-align:center;>" . $trouver['logiciel_version'] . "</td>";
                            echo "<td style=text-align:center;>" . $trouver['logiciel_off'] . "</td>";
                            echo "<td style=text-align:center;>" . $trouver['logiciel_type'] . "</td>";
                            echo "<td style=text-align:center;>" . $trouver['commentaire'] . "</td>";
                            echo '<td style=text-align:center;><a href="/wordpress/Logiciels/?id=' . $trouver['id_logiciel'] . '">Modifier</a></td>';
                            echo '<td style=text-align:center;><a href="/api/logiciel/delete/delete.php?id=' . $trouver['id_logiciel'] . '">Supprimer</a></td>';
                            echo "</tr>";
                        }
                }
            else
                {
                    foreach($result as $logiciel){
                        
                        if(isset($_GET['id']) && $logiciel['id_logiciel'] == $_GET['id'])
                        {
                            if(empty($result['logiciel_type'])){$result['logiciel_type']=null;}
                            echo '<td style=text-align:center; colspan="3"><form action="/api/logiciel/update/update.php" method="POST">';
                            echo "ID n° " ;echo $logiciel['id_logiciel'] . ' ' .  $logiciel['logiciel_editeur'] . ' ' .  $logiciel['logiciel_nom'];
                            ?><br><br><?php
                            echo '<input type="text" name="editeur" value="' . $logiciel['logiciel_editeur'] . '" placeholder="Editeur du logiciel">';
                            ?><br>
                            <br><?php
                            echo '<input type="text" name="nom" value="' . $logiciel['logiciel_nom'] . '" placeholder="Nom du logiciel">';
                            ?><br>
                            <br><?php
                            echo '<input type="text" name="version" value="' . $logiciel['logiciel_version'] . '" placeholder="Version du logiciel">';
                            ?><br>
                            <br><?php
                            echo '<input type="text" name="officiel" value="' . $logiciel['logiciel_off'] . '" placeholder="Statut">';
                            ?><br>
                            <br><?php
                            echo '<select name="type" id="" >';?>
                            <option value="<?php echo $result['logiciel_type'];?>" selected><?php echo $logiciel['logiciel_type'];?></option><?php
                            ?><option value=""></option><?php
                            ?><option value="Bureautique">Bureautique</option><?php
                            ?><option value="Soft-GE">Soft-GE</option><?php
                            ?><option value="Développement">Développement</option><?php
                            ?><option value="Internet">Internet</option><?php
                            ?><option value="Utilitaires">Utilitaires</option><?php
                            ?><option value="Autres">Autres</option><?php
                            echo '</select>';
                            ?><br>
                            <br><?php
                            echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $logiciel['commentaire'] . '</textarea>';
                            echo '<input type="submit" value="Modifier" name="modifier" >';
                            echo '<input type="hidden" name="logiciel" value="' . $logiciel['id_logiciel'] . '">';
                            echo "</form></td>";
                            
                        }
                        else
                        {
                            echo "<tr>";
                            echo "<td style=text-align:center;>" . $logiciel['id_logiciel'] . "</td>";
                            echo "<td style=text-align:center;>" . $logiciel['logiciel_editeur'] . "</td>";
                            echo "<td style=text-align:center;>" . $logiciel['logiciel_nom'] . "</td>";
                            echo "<td style=text-align:center;>" . $logiciel['logiciel_version'] . "</td>";
                            echo "<td style=text-align:center;>" . $logiciel['logiciel_off'] . "</td>";
                            echo "<td style=text-align:center;>" . $logiciel['logiciel_type'] . "</td>";
                            echo "<td style=text-align:center;>" . $logiciel['commentaire'] . "</td>";
                            echo '<td style=text-align:center;><a href="/wordpress/Logiciels/?id=' . $logiciel['id_logiciel'] . '">Modifier</a></td>';
                            echo '<td style=text-align:center;><a href="/api/logiciel/delete/delete.php?id=' . $logiciel['id_logiciel'] . '">Supprimer</a></td>';
                            echo "</tr>";
                        }
                    }
                }
                
        echo "</tbody>";
        
        ?>
    </div>
</div>
<?php

?>