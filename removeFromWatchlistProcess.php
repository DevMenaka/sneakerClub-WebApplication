<?php

require "connection.php";

if (isset($_GET["id"])) {
    
    $wid = $_GET["id"];

    $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$wid."'");
    $w_data = $w_rs->fetch_assoc();

    $user = $w_data["m_email"];
    $product = $w_data["item_id"];

    Database::iud("INSERT INTO `recent`(`item_id`,`m_email`)VALUES('".$product."','".$user."');");
    Database::iud("DELETE FROM `watchlist` WHERE `id`='".$wid."'");

    echo("1");

}else{
    echo("Somthing Went Wrong");
}

?>