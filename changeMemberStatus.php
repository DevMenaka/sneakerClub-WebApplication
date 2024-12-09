<?php

require "connection.php";

$email = $_GET["email"];

$m_rs = Database::search("SELECT * FROM `members` WHERE `email`='".$email."'");
$m_num = $m_rs->num_rows;

if ($m_num == 1){

    $m_data = $m_rs->fetch_assoc();
    $status = $m_data["status"];

    if ($status==1){

        Database::iud("UPDATE `members` SET `status`='2' WHERE `email`='".$email."'");
        echo("deactivated");
        
    }else if($status == 2){
        Database::iud("UPDATE `members` SET `status`='1' WHERE `email`='".$email."'");
        echo("activated");
    }

    
}else{
    echo("Something Went Wrong.Plese Try Agin Later");
}

?>