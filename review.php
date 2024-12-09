<?php
require "connection.php";

if(isset($_POST["email"])){

$itemId = $_POST["id"];
$email=$_POST["email"];
$status=$_POST["status"];
$comment = $_POST["comment"];


if ($comment==null){
     echo("Please Enter Your Comment");
}else {
     $data_rs = Database::search("SELECT*FROM `members` WHERE `email`='".$email."'");
     $mdata = $data_rs->fetch_assoc();
     $mstatus = $mdata["status"];
    if($status==$mstatus){
    $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `reviews`(`item_id`,`member_email`,`date_time`,`Comment`)VALUES
    ('".$itemId."','".$email."','".$date."','".$comment."');");
    echo("success");
    }else{
        echo("You Are Not Valied Member");
    }
}
    
}else{
  echo("Please Login First!");
}
