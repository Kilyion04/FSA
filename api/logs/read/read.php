<?php

session_start();
require 'C:/xampp/htdocs/config.php';



// On écrit notre requête
$sql = "SELECT * from logs

";

// On prépare la requête
$query = $dbo->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un divau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div>
    <div>
        <th>ID</th>
        <th>ID Personnel</th>
        <th>ID serveur</th>
        <th>ID logs</th>
        <th>Lociciel n°1</th>
        <th>Lociciel n°2</th>
        <th>Lociciel n°3</th>
        <th>Lociciel n°4</th>
        <th>Lociciel n°5</th>
        <th>Lociciel n°6</th>
        <th>Lociciel n°7</th>
        <th>Lociciel n°8</th>
        <th>Lociciel n°9</th>
        <th>Lociciel n°10</th>
        <th>Commentaire</th>
    </div>
    <div>
        <?php
        echo "<tbody>";
            foreach($result as $logs){
                
                if(isset($_GET['id']) && $logs['id_logs'] == $_GET['id'])
                {
                    if(empty($result['logiciel_type'])){$result['logiciel_type']=null;}
                    echo '<td style=text-align:center; colspan="3"><form action="/api/logs/update/update.php" method="POST">';
                    echo "ID n° " ;echo $logs['id_logs'] . ' ' .  $logs['logs_serveur'] . ' ' .  $logs['logs_pc'];
                    ?><br><br><?php
                    echo '<input type="number" name="serveur" value="' . $logs['logs_serveur'] . '" placeholder="ID du serveur">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs" value="' . $logs['logs_pc'] . '" placeholder="id du logs">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_1" value="' . $logs['logs_1'] . '" placeholder="Logiciel n°1">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_2" value="' . $logs['logs_2'] . '" placeholder="Logiciel n°2">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_3" value="' . $logs['logs_3'] . '" placeholder="Logiciel n°3">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_4" value="' . $logs['logs_4'] . '" placeholder="Logiciel n°4">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_5" value="' . $logs['logs_5'] . '" placeholder="Logiciel n°5">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_6" value="' . $logs['logs_6'] . '" placeholder="Logiciel n°6">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_7" value="' . $logs['logs_7'] . '" placeholder="Logiciel n°7">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_8" value="' . $logs['logs_8'] . '" placeholder="Logiciel n°8">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_9" value="' . $logs['logs_9'] . '" placeholder="Logiciel n°9">';
                    ?><br>
                    <br><?php
                    echo '<input type="number" name="logs_10" value="' . $logs['logs_10'] . '" placeholder="Logiciel n°10">';
                    ?><br>
                    <br><?php
                    echo '<textarea name="commentaire" id="" cols="50" rows="5"  placeholder="Commentaire">' . $logs['logs_commentaire'] . '</textarea>';
                    echo '<input type="submit" value="Modifier" name="modifier" >';
                    echo '<input type="hidden" name="logiciel" value="' . $logs['id_logs'] . '">';
                    echo "</form></td>";
                    
                }
                else
                {
                    echo "<tr>";
                    echo "<td style=text-align:center;>" . $logs['id_logs'] . "</td>";
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Personnel/?log='. $logs["logs_perso"] . '">' . $logs['logs_perso'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Serveurs/?log='. $logs["logs_serveur"] . '">' . $logs['logs_serveur'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/PC/?log='. $logs["logs_pc"] . '">' . $logs['logs_pc'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_1"] . '">' . $logs['logs_1'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_2"] . '">' . $logs['logs_2'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_3"] . '">' . $logs['logs_3'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_4"] . '">' . $logs['logs_4'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_5"] . '">' . $logs['logs_5'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_6"] . '">' . $logs['logs_6'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_7"] . '">' . $logs['logs_7'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_8"] . '">' . $logs['logs_8'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_9"] . '">' . $logs['logs_9'] . '</a></td>';
                    echo '<td style=text-align:center;><a href="http://localhost/wordpress/Logiciels/?log='. $logs["logs_10"] . '">' . $logs['logs_10'] . '</a></td>';
                    echo "<td style=text-align:center;>" . $logs['logs_commentaire'] . "</td>";
                    echo '<td style=text-align:center;><a href="/wordpress/Liste logiciels/?id=' . $logs['id_logs'] . '">Modifier</a></td>';
                    echo '<td style=text-align:center;><a href="/api/logs/delete/delete.php?id=' . $logs['id_logs'] . '">Supprimer</a></td>';
                    echo "</tr>";
                }
            }  
        echo "</tbody>";
        
        ?>
    </div>
</div>
<?php

?>