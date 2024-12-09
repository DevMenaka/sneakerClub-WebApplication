<?php

require "connection.php";

$admin = $_GET["email"];

$admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$admin."'");
$admin_num = $admin_rs->num_rows;

if ($admin_num == 1){

    $admin_data = $admin_rs->fetch_assoc();
    $status = $admin_data["status_id"];

    if ($status==1){

        Database::iud("UPDATE `admin` SET `status_id`='2' WHERE `email`='".$admin."'");
        echo("deactivated");
        
    }else if($status == 2){
        Database::iud("UPDATE `admin` SET `status_id`='1' WHERE `email`='".$admin."'");
        echo("activated");
    }

    
}else{
    echo("Something Went Wrong.Plese Try Agin Later");
}

?>