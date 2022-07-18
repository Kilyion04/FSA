<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM imprimante WHERE id_imprimante= $id ")->execute([$id]);


header("location: /wordpress/Imprimantes/");

$dbo = null;