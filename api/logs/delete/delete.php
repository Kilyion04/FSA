<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM logs WHERE id_logs= $id ")->execute([$id]);


header("location: /wordpress/Liste logiciels/");

$dbo = null;