<?php

require 'C:/xampp/htdocs/config.php';


$imprimer_imprimante = $_POST["imprimer_imprimante"];
$imprimer_personnel = $_POST["imprimer_personnel"];
$imprimer_cartouche = $_POST["imprimer_cartouche"];



if(!empty($imprimer_imprimante))
{
    $sql = "INSERT INTO imprimer
    (id_imprimante,
    id_personnel,
    id_cartouche)
    VALUES
    (:imprimante,
    :personnel,
    :cartouche)";
    $stmt= $dbo->prepare($sql);
    $stmt->execute(array(
        ':imprimante' => $imprimer_imprimante,
        ':personnel' => $imprimer_personnel,
        ':cartouche' => $imprimer_cartouche
    ));
}
$dbo = null;
?>
