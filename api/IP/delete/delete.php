<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM ip WHERE id_ip= $id ")->execute([$id]);


header("location: /wordpress/IP/");

$dbo = null;