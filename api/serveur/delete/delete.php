<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM serveur WHERE id_serveur= $id ")->execute([$id]);


header("location: /wordpress/Serveurs/");

$dbo = null;