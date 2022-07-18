<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM station_accueil WHERE id_station= $id ")->execute([$id]);


header("location: /wordpress/Stations/");

$dbo = null;