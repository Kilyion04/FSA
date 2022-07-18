<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM logiciel WHERE id_logiciel= $id ")->execute([$id]);


header("location: /wordpress/Logiciels/");

$dbo = null;