<?php
include 'config.php';


if(empty($_FILES['logo'] ['name'])) {
    $file_name = $_POST['old-logo'];

}else{
    $errors = array();

    $file_name = $_FILES['logo'] ['name'];
    $file_size = $_FILES['logo'] ['size'];
    $file_tmp = $_FILES['logo'] ['tmp_name'];
    $file_type = $_FILES['logo'] ['type'];
    $file_ext =  strtolower(end(explode('.',$file_name)));
    $extension = array("jpg", "png", "jpeg");
 
    if(in_array($file_ext, $extension) == false) {
          $errors[] = "This extension file not allowed, Please choose a JPG or PNG file";
    }
 
    if($file_size > 2097152) {
           $errors[] = "File size must be 2mb or lower";
    }
 
    if(empty($errors) == true) {
            move_uploaded_file($file_tmp,"images/".$file_name);
    }else{
     print_r($error);
     die();
    }
 
 }
 

$websitename = mysqli_real_escape_string($conn, $_POST['website_name']);
$footerdesc = mysqli_real_escape_string($conn, $_POST['footer_dec']);
$sql = "UPDATE setting SET websitename = '{$websitename}', logo = '{$file_name}', footerdesc = '{$footerdesc}'";

if(mysqli_query($conn, $sql)) {
    header("Location: {$header}/admin/settings.php");
}else{
    echo "Query failed";
}





?>