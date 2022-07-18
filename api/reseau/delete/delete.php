<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM prise_reseau WHERE id_prise_reseau= $id ")->execute([$id]);


header("location: /wordpress/Prises réseau/");

$dbo = null;