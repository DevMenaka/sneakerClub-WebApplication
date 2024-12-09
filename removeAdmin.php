<?php

require "connection.php";

if (isset($_GET["id"])) {
    
    $id = $_GET["id"];

    $mrs = Database::search("SELECT * FROM `admin` WHERE `id`='".$id."'");
    $mdata = $mrs->fetch_assoc();

    Database::iud("DELETE FROM `admin_image` WHERE `admin_id`='".$id."'");
    Database::iud("DELETE FROM `admin` WHERE `id`='".$id."'");
    

    echo("Admin Acount Is Removed!!");

}else{
    echo("Somthing Went Wrong");
}

?>