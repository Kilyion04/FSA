<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];
$ip = $_GET['ip'];

$dbo->prepare("DELETE FROM pc WHERE id_pc= $id ")->execute([$id]);
$dbo->prepare("DELETE FROM ip WHERE ip_adresse= '$ip' ")->execute([$ip]);


header("location: /wordpress/PC/");

$dbo = null;