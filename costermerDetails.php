<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])){

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];
    $line1 = $_POST["address1"];
    $line2 = $_POST["address2"];
    $province = $_POST["province"];
    $district = $_POST["distirict"];
    $city = $_POST["city"];
    $pcode = $_POST["pcode"];

   
    Database::iud("UPDATE `members` SET `fname`='".$fname."',`lname`='".$lname."'
    WHERE `email`='".$_SESSION["u"]["email"]."'");

    $mobileRs=Database::search("SELECT `mobile` FROM `members` WHERE `email`= '".$_SESSION["u"]["email"]."'");
    $mobileNum = $mobileRs->num_rows;

    if (0<$mobileNum){
        Database::iud("UPDATE `members` SET `mobile`='".$mobile."' WHERE `email`='".$_SESSION["u"]["email"]."'");
    }else{
        Database::iud("INSERT INTO `members` SET `mobile`='".$mobile."'WHERE `email`='".$_SESSION["u"]["email"]."'");
    }

    $adress_rs=Database::search("SELECT * FROM `member_has_adress` WHERE
    `member_mail`='".$_SESSION["u"]["email"]."'");
    $adress_num = $adress_rs->num_rows;

    if($adress_num==1){
         Database::iud("UPDATE `member_has_adress` SET `line1`='".$line1."',
         `line2`='".$line2."',
         `city_id`='".$city."',
         `province_id`='".$province."',
         `district_id`='".$district."',
         `zip`='".$pcode."' WHERE `member_mail`='".$_SESSION["u"]["email"]."'");
    }else{

        Database::iud("INSERT INTO `member_has_adress`
        (`line1`,`line2`,`member_mail`,`city_id`,`province_id`,`district_id`,`zip`) VALUES 
        ('".$line1."','".$line2."','".$_SESSION["u"]["email"]."','".$city."','".$province."','".$district."','".$pcode."')");

    }
    echo("success");

}else{
    echo("Please Login first");
}
?>