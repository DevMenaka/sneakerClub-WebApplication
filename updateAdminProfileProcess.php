<?php
require "connection.php";

if (isset($_GET["id"])){

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $email = $_POST["e"];

    if(isset($_FILES["image"])){
        $image=$_FILES["image"];

        $allowed_image_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");
        $file_ex=$image["type"];
    
       
        if (!in_array($file_ex,$allowed_image_extentions)) {
            echo("Please select a valid image.");
        }else{

            $new_file_extention;

            if ($file_ex=="image/jpg"){
                $new_file_extention =".jpg";
            }elseif($file_ex =="image/jpeg"){
                $new_file_extention =".jpeg";
            }elseif($file_ex=="image/png"){
                $new_file_extention=".png";
            }elseif($file_ex == "image/svg+xml"){
                $new_file_extention=".svg";
            }
            $file_name="images/adminImage".$_GET["id"]."_".uniqid().$new_file_extention;

            move_uploaded_file($image["tmp_name"],$file_name);

            $image_rs = Database::search("SELECT * FROM `admin_image` WHERE  
            `admin_id`='".$_GET["id"]."'");
            $image_num = $image_rs->num_rows;

            if ($image_num == 1){
                Database::iud("UPDATE `admin_image` SET `url`='".$file_name."' 
                WHERE `admin_id`='".$_GET["id"]."'");

            }else{
                    Database::iud("INSERT INTO `admin_image` (`admin_id`,`url`)
                    VALUES('".$_GET["id"]."','".$file_name."')");

                }
        }

    }

    Database::iud("UPDATE `admin` SET `fname`='".$fname."',`lname`='".$lname."',`email`='".$email."'
    WHERE `id`='".$_GET["id"]."'");
    echo("success");

}else{
    echo("Error");
}

?>