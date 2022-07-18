<?php

require 'C:/xampp/htdocs/config.php';

if(isset($_POST['liste'])){
    $id = $_POST['liste'];
    $personnel = $_POST['personnel'];
    $serveur = $_POST['serveur'];
    $pc = $_POST['pc'];
    $logs_1 = $_POST['logs_1'];
    $logs_2 = $_POST['logs_2'];
    $logs_3 = $_POST['logs_3'];
    $logs_4 = $_POST['logs_4'];
    $logs_5 = $_POST['logs_5'];
    $logs_6 = $_POST['logs_6'];
    $logs_7 = $_POST['logs_7'];
    $logs_8 = $_POST['logs_8'];
    $logs_9 = $_POST['logs_9'];
    $logs_10 = $_POST['logs_10'];
    
    $sql = "UPDATE logs SET logs_personnel = :personnel,
    logs_serveur = :serveur,
    logs_pc = :pc,
    logs_1 = :logs_1,
    logs_2 = :logs_2,
    logs_3 = :logs_3,
    logs_4 = :logs_4,
    logs_5 = :logs_5,
    logs_6 = :logs_6,
    logs_7 = :logs_7,
    logs_8 = :logs_8,
    logs_9 = :logs_9,
    logs_10 = :logs_10
    ";
    $statement = $dbo->prepare($sql);

    $statement->execute(array(
        ":id" => $id ,
        ":personnel" => $personnel ,
        ":serveur" => $serveur ,
        ":pc" => $pc ,
        ":logs_1" => $logs_1 ,
        ":logs_2" => $logs_2 ,
        ":logs_3" => $logs_3 ,
        ":logs_4" => $logs_4 ,
        ":logs_5" => $logs_5 ,
        ":logs_6" => $logs_6 ,
        ":logs_7" => $logs_7 ,
        ":logs_8" => $logs_8 ,
        ":logs_9" => $logs_9 ,
        ":logs_10" => $logs_10 
    ));
    echo $_POST['logs'];
}
else{
    echo "erreur";
}


header("location: /wordpress/Liste logiciels/");


?>