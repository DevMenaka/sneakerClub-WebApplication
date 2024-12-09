<?php

require "connection.php";

if (isset($_GET["id"])) {
    
    $cid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='".$cid."'");
    $cart_data = $cart_rs->fetch_assoc();

    $user = $cart_data["user_mail"];
    $product = $cart_data["item_id"];

    Database::iud("INSERT INTO `recent`(`item_id`,`m_email`)VALUES('".$product."','".$user."');");
    Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."'");

    echo("1");

}else{
    echo("Somthing Went Wrong");
}

?>