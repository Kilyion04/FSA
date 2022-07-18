<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM tablette WHERE id_tablette= $id ")->execute([$id]);


header("location: /wordpress/Tablettes/");

$dbo = null;