<?php
require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["newAdminEmail"];

if(empty($email)){
    echo("Please Enter Email !!!");
}elseif(strlen($email)>100){
    echo("Email must have less than 100 characters");
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email !!!");
}else{
    
        $admin = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
        $num = $admin->num_rows;
    
        if ($num == 1) {
            echo("This Admin already exists");
        }else{
            Database::iud("INSERT INTO `admin`(`email`,`status_id`)VALUES('".$email."','2');");
            $url = "http://localhost/sneekerclub/adminlogin.php";
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'projecteshop8@gmail.com';
            $mail->Password = 'otlgibgxuhmyfhky';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('projecteshop8@gmail.com', 'Admin Verification');
            $mail->addReplyTo('projecteshop8@gmail.com', 'Admin Verefication');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'SneekerClub Admin Verification Code';
            $bodyContent = '<h1 style="color:green">Sneaker Club Admin Login '.$url.'</h1>';
            $mail->Body= $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo("Done");
            }
    
        }
}
