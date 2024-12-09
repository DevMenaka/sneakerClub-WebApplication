<?php

require "connection.php";

$npw = $_POST["nPw"];
$cpw = $_POST["cPw"];
$vcode = $_POST["vc"];

if (empty($npw)) {
    echo("Please Enter Your New Password !!");
}elseif(empty($cpw)){
    echo("Please Conform Your Password !!");
}elseif($npw!=$cpw){
    echo("Passwords entered do not match !!");
}elseif(empty($vcode)){
    echo("Please Enter Verification Code !!");  
}else{

   $rs = Database::search("SELECT * FROM `members` WHERE `verification_code`='".$vcode."'");
   $rnum =  $rs->num_rows;

   if (0<$rnum) {
    Database::iud("UPDATE `members` SET `password`='".$cpw."' WHERE `verification_code`='".$vcode."'");
    
    echo("success");

   }else{
     echo("Something Went Wrong!!");
   }

}


?>