<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM cartouche WHERE id_cartouche= $id ")->execute([$id]);


header("location: /wordpress/Cartouches/");

$dbo = null;