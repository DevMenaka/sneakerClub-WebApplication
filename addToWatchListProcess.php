<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {  
    if (isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `item_id`='".$pid."' AND `m_email`='".$email."'");
        $w_num = $w_rs->num_rows;

        if ($w_num==1) {

                echo("Your item has already been added to the watchlist");

        }else{

            Database::iud("INSERT INTO `watchlist`(`item_id`,`m_email`)VALUES
            ('".$pid."','".$email."')");
            echo("Product Added To Watchlist");

        }
        
    }else{
        echo("Something Went Wrong");
    }

}else{
    echo("Please Sign In or Register");
}
