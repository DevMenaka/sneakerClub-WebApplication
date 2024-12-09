<?php
require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];

if (empty($fname)){
    echo("Please Enter Your First Name !!!");
}elseif(strlen($fname)>50){
    echo("First Name must have less than 50 characters");
}elseif(empty($lname)) {
    echo("Please Enter Your Last Name !!!");
}elseif(strlen($lname)>50){
    echo("First Name must have less than 50 characters");
}elseif(empty($email)) {
    echo("Please Enter Your Email !!!");
}elseif(strlen($email)>100){
    echo("Email must have less than 100 characters");
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email !!!");
}elseif(empty($password)){
    echo("Please Enter Your Password !!!");
}elseif(strlen($password) <5 || strlen($password) > 20){
    echo("Password must be between 5-20 characters");
}else{
   
    $rs = Database::search("SELECT * FROM `members` WHERE `email`='".$email."'");
    $n = $rs->num_rows; 

    if($n > 0 ){
        echo("User With the same Email already exists.");
    }else{
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
    

    Database::iud("INSERT INTO `members`
    (`email`,`fname`,`lname`,`password`,`signup_date`,`status`) VALUES
    ('".$email."','".$fname."','".$lname."','".$password."','".$date."','1')");

    echo "success";
    }

}
?>