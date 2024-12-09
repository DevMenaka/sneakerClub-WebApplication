<?php

require "connection.php";

if (isset($_GET["email"])) {
    
    $email = $_GET["email"];

    $mrs = Database::search("SELECT * FROM `members` WHERE `email`='".$email."'");
    $mdata = $mrs->fetch_assoc();

    Database::iud("DELETE FROM `invoice` WHERE `member_email`='".$email."'");
    Database::iud("DELETE FROM `cart` WHERE `user_mail`='".$email."'");
    Database::iud("DELETE FROM `member_has_adress` WHERE `member_mail`='".$email."'");
    Database::iud("DELETE FROM `recent` WHERE `m_email`='".$email."'");
    Database::iud("DELETE FROM `reviews` WHERE `member_email`='".$email."'");
    Database::iud("DELETE FROM `watchlist` WHERE `m_email`='".$email."'");
    Database::iud("DELETE FROM `members` WHERE `email`='".$email."'");
    

    echo("Member Acount Is Removed!!");

}else{
    echo("Somthing Went Wrong");
}

?>