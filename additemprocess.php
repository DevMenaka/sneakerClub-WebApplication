<?php
require "connection.php";

$brand = $_POST["b"];
$type = $_POST["t"];
$size = $_POST["s"];
$colour = $_POST["c"];
$title = $_POST["ti"];
$description = $_POST["d"];
$qty = $_POST["q"];
$price = $_POST["p"];
$dfc = $_POST["dfc"];
$dfo = $_POST["dfo"];

if ($brand == "0") {
    echo ("Plese Select a Brand");
} else if ($type == "0") {
    echo ("Please Select a Type");
} else if ($size=="0") {
    echo ("Please Enter a Size");
} else if ($colour == "0") {
    echo ("Plese Select a Colour");
}else if (empty($title)) {
    echo ("Please Enter item Title");
} else if (strlen($title <= 100)) {
    echo ("Title Should Have Lover Than 100 Characters");
} else if (empty($description)) {
    echo ("Please Enter a Description.");
} else if ($qty == "0" | $qty == "e" | $qty < 0) {
    echo ("Invalid Input For Quantity");
} else if (empty($price)) {
    echo ("Please Enter the Price.");
} else if (!is_numeric($price)) {
    echo ("Invalid input For Price");
} else if (empty($dfc)) {
    echo ("Please Enter the Delivery fee For Colombo.");
} else if (!is_numeric($dfc)) {
    echo ("Invalid input For delivery cost inside Colombo");
} else if (empty($dfo)) {
    echo ("Please Enter the Delivery fee For out of Colombo.");
}else if (!is_numeric($dfo)) {
    echo ("Invalid input For delivery cost out of Colombo");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `items`
    (`title`,`description`,`price`,`qty`,`delevery_fee_colombo`,`delever_fee_other`,`date_time_added`,`our_brands_id`,
    `type_id`,`sizes_id`,`colour_id`,`status`) VALUES 
    ('" . $title . "','" . $description . "','" . $price . "','" . $qty . "','" . $dfc . "','" . $dfo . "','" . $date . "','" . $brand . "',
    '" . $type . "','" . $size . "','" . $colour . "','" . $status . "')");

    

    $item_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

        if($length <= 6 && $length > 0){

            $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/webp");

            for($x = 0; $x < $length;$x++){
                if(isset($_FILES["img".$x])){

                    $img_file = $_FILES["img".$x];
                    $file_extention = $img_file["type"];

                    if(in_array($file_extention,$allowed_img_extentions)){

                        $new_img_extention;

                        if($file_extention == "image/jpg"){
                            $new_img_extention = ".jpg";
                        }else if($file_extention == "image/jpeg"){
                            $new_img_extention = ".jpeg";
                        }else if($file_extention == "image/png"){
                            $new_img_extention = ".png";
                        }else if($file_extention == "image/webp"){
                            $new_img_extention = ".webp";
                        }

                        $file_name = "images//item_images//".$title."_".$x."_".uniqid().$new_img_extention;
                        move_uploaded_file($img_file["tmp_name"],$file_name);

                        Database::iud("INSERT INTO `images`(`path`,`items_id`) VALUES ('".$file_name."','".$item_id."')");

                }else{
                    echo ("Invalid Image type");
                }

            }
        }

        echo ("Product Saved Successfully");

    }else{

        echo("Invalid Image Count");
    }

}

?>
