<?php
session_start();
require "connection.php";

$iid = $_POST["iid"];
$amount = $_POST["total"];
$qty = $_POST["qty"];
$mail = $_POST["user"];
$orderId = $_POST["orderId"];

$product_rs = Database::search("SELECT * FROM `items` WHERE `id`='".$iid."'");
    $product_data = $product_rs->fetch_assoc();

    $curr_qty = $product_data["qty"];
    $new_qty = $curr_qty - $qty;

    Database::iud("UPDATE `items` SET `qty`='".$new_qty."' WHERE `id`='".$iid."'");

    
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`item_id`,`member_email`)
    VALUES('".$orderId."','".$date."','".$amount."','".$qty."','1','".$iid."','".$mail."')");

    echo "1";

?>