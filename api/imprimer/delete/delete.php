<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM imprimer WHERE id_imprimer= $id ")->execute([$id]);


header("location: /wordpress/imprimante/");

$dbo = null;