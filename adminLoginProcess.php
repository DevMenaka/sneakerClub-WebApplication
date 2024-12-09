<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["adminemail"])){
    $gmail = $_POST["adminemail"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$gmail."'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0){
        $code = uniqid();

        Database::iud("UPDATE `admin` SET `vcode`='".$code."'WHERE `email`='".$gmail."'");

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
            $mail->addAddress($gmail);
            $mail->isHTML(true);
            $mail->Subject = 'SneekerClub Admin Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body= $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'success';
            }

    }else{
        echo("You are not a valid user");
    }

}else{
    echo("Email field not be empty.");
}

?>