<?php

require "connection.php";

if (isset($_GET["id"])) {
    
    $iid = $_GET["id"];

    $item_rs = Database::search("SELECT * FROM `items` WHERE `id`='".$iid."'");
    $item_data = $item_rs->fetch_assoc();

    Database::iud("DELETE FROM `images` WHERE `items_id`='".$iid."'");
    Database::iud("DELETE FROM `recent` WHERE `item_id`='".$iid."'");
    Database::iud("DELETE FROM `watchlist` WHERE `id`='".$iid."'");
    Database::iud("DELETE FROM `cart` WHERE `id`='".$iid."'");
    Database::iud("DELETE FROM `items` WHERE `id`='".$iid."'");
    

    echo("1");

}else{
    echo("Somthing Went Wrong");
}

?>