<?php

session_start();
require 'C:/xampp/htdocs/config.php';



// On écrit notre requête
$sql =
"SELECT ip.id_ip, ip_adresse,ip.id_utiliser, ip_actif, ip_adresse_mac, ip.commentaire
    FROM ip
    LEFT JOIN utiliser ON ip.id_ip = utiliser.id_ip 
";

$req = "SELECT * FROM ip
WHERE id_ip like :terme OR
id_ip like :un OR
ip_adresse like :deux OR
id_utiliser like :trois OR
ip_actif like :quatre OR
ip_adresse_mac like :cinq ";

$rec = "SELECT * FROM ip where ip_adresse = :recherche";

// On prépare la requête
$query = $dbo->prepare($sql);

$requete = $dbo->prepare($req);

$recherche = $dbo->prepare($rec);

// On exécute la requête
$query->execute();

$requete->execute();

$recherche->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div>
    <div>
        <th>ID</th>
        <th>Adresse IP</th>
        <th>Affectation</th>
        <th>Actif</th>
        <th>Adresse MAC</th>
        <th>Commentaire</th>
    </div>
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
                            echo "<td style=text-align:center;>" . $find['id_ip'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['ip_adresse'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['id_utiliser'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['ip_actif'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['ip_adresse_mac'] . "</td>";
                            echo "<td style=text-align:center;>" . $find['commentaire'] . "</td>";
                            echo '<td style=text-align:center;><a href="/wordpress/IP/?id=' . $find['id_ip'] . '">Modifier</a></td>';
                            echo '<td style=text-align:center;><a href="/api/ip/delete/delete.php?id=' . $find['id_ip'] . '">Supprimer</a></td>';
                            echo "</tr>";
                        }
                }
        elseif(isset($_GET['ip'])  && !empty($_GET['ip']) )
                {
                    $id = $_GET['ip'];
                    $recherche->execute(array(
                        ':recherche'=> $id
                    ));
                    $un = $recherche->fetchAll(PDO::FETCH_ASSOC);                         

                    foreach($un as $deux)
                        {
                            echo "<tr>";
                            echo "<td style=text-align:center;>" . $deux['id_ip'] . "</td>";
                            echo "<td style=text-align:center;>" . $deux['ip_adresse'] . "</td>";
                            echo "<td style=text-align:center;>" . $deux['id_utiliser'] . "</td>";
                            echo "<td style=text-align:center;>" . $deux['ip_actif'] . "</td>";
                            echo "<td style=text-align:center;>" . $deux['ip_adresse_mac'] . "</td>";
                            echo "<td style=text-align:center;>" . $deux['commentaire'] . "</td>";
                            echo '<td style=text-align:center;><a href="/wordpress/IP/?id=' . $deux['id_ip'] . '">Modifier</a></td>';
                            echo '<td style=text-align:center;><a href="/api/ip/delete/delete.php?id=' . $deux['id_ip'] . '">Supprimer</a></td>';
                            echo "</tr>";
                        }
                }
        else
        {
            foreach($result as $ip)
            {
                if(isset($_GET['id']) && $ip['id_ip'] == $_GET['id'])
                {
                    echo '<td style=text-align:center; colspan="3"><form action="/api/ip/update/update.php" method="POST">';
                    echo "Adresse ip : " ;echo $ip['ip_adresse'];
                    ?><br><?php
                    echo '<input type="text" name="adresse" value="' . $ip['ip_adresse'] . '" placeholder="Adresse IP" style="width: 18%;">';                    
                    ?><br>
                    <br><?php
                    echo 'Affectation :';
                    ?><br><?php
                    echo '<input type="number" name="affectation" value="' . $ip['id_utiliser'] . '" placeholder="Affectation" style="width: 18%;">';
                    ?><br>
                    <br><?php
                    echo 'Actif :';
                    ?><br>                   
                    <?php
                    echo '<select name="actif" id="" style="width: 18%;" >';
                    ?>
                    <option value="<?php echo $ip['ip_actif'];?>" ><?php echo $ip['ip_actif'];?></option> <?php
                    ?>
                    <option value="oui" > oui </option> <?php
                    ?>
                    <option value="non" > non </option>
                    <?php
                        
                    echo '</select>';
                    ?><br>
                    <?php
                    echo 'Adresse mac :';
                    ?><br><?php
                    echo '<input type="text" name="mac" value="' . $ip['ip_adresse_mac'] . '" placeholder="Adresse mac">';                    
                    ?><br>
                    <br><?php
                    echo 'Commentaire :';
                    ?><br><?php
                    echo '<textarea name="commentaire" id="" cols="50" rows="5" value="' . $ip['commentaire'] . '" placeholder="Commentaire">' . $ip['commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="ip" value="' . $ip['id_ip'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $ip['id_ip'] . "</td>";
                    echo "<td style=text-align:center;>" . $ip['ip_adresse'] . "</td>";
                    echo "<td style=text-align:center;>" . $ip['id_utiliser'] . "</td>";
                    echo "<td style=text-align:center;>" . $ip['ip_actif'] . "</td>";
                    echo "<td style=text-align:center;>" . $ip['ip_adresse_mac'] . "</td>";
                    echo "<td style=text-align:center;>" . $ip['commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/IP/?id=' . $ip['id_ip'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/ip/delete/delete.php?id=' . $ip['id_ip'] . '">Supprimer</a></td>';
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