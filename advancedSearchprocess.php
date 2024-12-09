<?php

require "connection.php";

$title = $_POST["title"];
$brand = $_POST["brand"];
$type = $_POST["type"];
$size = $_POST["size"];
$colour = $_POST["colour"];
$priceF = $_POST["priceF"];
$priceT = $_POST["priceT"];
$sortId = $_POST["sortId"];

$query = "SELECT * FROM `items`";
$status = 0;

if ($sortId==0) {

    if (!empty($title)){
        $query .= " WHERE `title` LIKE '%".$title."%'";
        $status = 1;
    }

    if ($status==0 && $brand!=0) {
        $query .= "WHERE `our_brands_id`='".$brand."'";
        $status = 1;
    }else if($status!=0 && $brand!=0){
        $query .= "AND `our_brands_id`='".$brand."' ";
    }

}else if ($sortId==1) {
    echo("Price High to low");
}else if ($sortId==2) {
    echo("Price Low to High");
}else if ($sortId==3) {
    echo("qty High to low");
}else if ($sortId==4) {
    echo("qty Low to Heght");
}




?>