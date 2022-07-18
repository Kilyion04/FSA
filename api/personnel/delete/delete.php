<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM personnel WHERE id_personnel= $id ")->execute([$id]);


header("location: /wordpress/personnel/");

$dbo = null;