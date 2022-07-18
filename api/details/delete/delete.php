<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM utiliser WHERE id_utiliser= $id ")->execute([$id]);


header("location: /wordpress/Details/");

$dbo = null;