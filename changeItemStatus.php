<?php

require "connection.php";

$item = $_GET["id"];

$item_rs = Database::search("SELECT * FROM `items` WHERE `id`='".$item."'");
$item_num = $item_rs->num_rows;

if ($item_num == 1){

    $item_data = $item_rs->fetch_assoc();
    $status = $item_data["status"];

    if ($status==1){

        Database::iud("UPDATE `items` SET `status`='2' WHERE `id`='".$item."'");
        echo("deactivated");
        
    }else if($status == 2){
        Database::iud("UPDATE `items` SET `status`='1' WHERE `id`='".$item."'");
        echo("activated");
    }

    
}else{
    echo("Something Went Wrong.Plese Try Agin Later");
}

?>