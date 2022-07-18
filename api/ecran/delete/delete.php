<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM ecran WHERE id_ecran= $id ")->execute([$id]);


header("location: /wordpress/Ecrans/");

$dbo = null;