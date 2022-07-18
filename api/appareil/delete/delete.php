<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM appareil_mesure WHERE id_appareil= $id ")->execute([$id]);


header("location: /wordpress/Appareils de mesure/");

$dbo = null;