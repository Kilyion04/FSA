<?php
require 'C:/xampp/htdocs/config.php';

$id = $_GET['id'];

$dbo->prepare("DELETE FROM disque_dur WHERE id_disque= $id ")->execute([$id]);


header("location: /wordpress/Disques dur/");

$dbo = null;