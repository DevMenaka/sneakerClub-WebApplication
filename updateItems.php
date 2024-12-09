<?php
require "connection.php";

if(isset($_GET["id"])){

    $pid = $_GET["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];

    Database::iud("UPDATE `items` SET `title`='".$title."',`description`='".$description."',`qty`='".$qty."',`delevery_fee_colombo`='".$dwc."',
    `delever_fee_other`='".$doc."' WHERE `id`='".$pid."'");

    echo ("Product has been updated!");

    $length = sizeof($_FILES);
    $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    if($length <= 6 && $length > 0){
        Database::iud("DELETE FROM `images` WHERE `items_id`='".$pid."'");
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

                    $file_name = "images/item_images".$title."_".$x."_".uniqid().$new_file_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images`(`path`,`items_id`) VALUES ('".$file_name."','".$pid."')");
                    

                }else{
                    echo ("Invalid image type");
                }

            }
        }
        echo ("success");

    }else{
        echo ("Image Not Upload Or Invalid Image Count!");
    }

}

?>
