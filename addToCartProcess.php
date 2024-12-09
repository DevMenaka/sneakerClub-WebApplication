<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {  
    if (isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `item_id`='".$pid."' AND `user_mail`='".$email."'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `items` WHERE `id`='".$pid."'");
        $product_data = $product_rs->fetch_assoc();
        $product_qty = $product_data["qty"];

        if ($cart_num==1) {
            
            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["cart_qty"];
            $new_qty = (int)$current_qty+1;

            if ($product_qty >= $new_qty) {

                Database::iud("UPDATE `cart` SET `cart_qty`='".$new_qty."' WHERE `item_id`='".$pid."' AND `user_mail`='".$email."' ");
                echo("Product Updated");

            }else{
                echo("Invalid Quantity");
            }

        }else{

            Database::iud("INSERT INTO `cart`(`item_id`,`user_mail`,`cart_qty`)VALUES
            ('".$pid."','".$email."','1')");
            echo("Product Added To Cart");

        }
        
    }else{
        echo("Something Went Wrong");
    }

}else{
    echo("Please Sign In or Register");
}

?>