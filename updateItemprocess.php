<?php

session_start();
require "connection.php";

if(isset($_SESSION["p"])){

    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];

    Database::iud("UPDATE `product` SET `title`='".$title."',`qty`='".$qty."',`delivery_fee_colombo`='".$dwc."',
    `delivery_fee_other`='".$doc."',`description`='".$description."' WHERE `id`='".$pid."'");

    echo ("Product has been updated!");

    Database::iud("DELETE FROM `images` WHERE `product_id`='".$pid."'");

    $length = sizeof($_FILES);
    $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    if($length <= 3 && $length > 0){

        for($x = 0;$x < $length;$x++){
            if(isset($_FILES["i".$x])){

                $img_file = $_FILES["i".$x];
                $file_extention = $img_file["type"];

                if(in_array($file_extention,$allowed_img_extentions)){

                    $new_file_extention;

                    if($file_extention == "image/jpg"){
                        $new_file_extention = ".jpg";
                    }else if($file_extention == "image/jpeg"){
                        $new_file_extention = ".jpeg";
                    }else if($file_extention == "image/png"){
                        $new_file_extention = ".png";
                    }else if($file_extention == "image/svg+xml"){
                        $new_file_extention = ".svg";
                    }

                    $file_name = "resource//mobile_images//".$title."_".$x."_".uniqid().$new_file_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('".$file_name."','".$pid."')");
                    echo ("success");

                }else{
                    echo ("Invalid image type");
                }

            }
        }

    }else{
        echo ("Invalid Image Count!");
    }

}

?>
