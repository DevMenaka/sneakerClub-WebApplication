<?php
require "connection.php";
session_start();

if(isset($_GET["v"])){

    $v = $_GET["v"];

    $admin = Database::search("SELECT * FROM `admin` WHERE `vcode`='".$v."'");
    $num = $admin->num_rows;

    if ($num == 1) {
        $data = $admin->fetch_assoc();
        $_SESSION["au"] = $data;
        Database::iud("UPDATE `admin` SET `status_id`='1'WHERE `vcode`='".$v."'");
        echo("success");
    }else{
        echo("Invalid Verification");
    }


}else{
    echo("Plese enter your Verification");
}

?>