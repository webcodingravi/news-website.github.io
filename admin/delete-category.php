<?php

include 'config.php';

$cat_id = $_GET['id'];
$sql = "DELETE FROM category WHERE category_id = '{$cat_id}'";

if(mysqli_query($conn, $sql)) {
    header("Location: {$header}/admin/category.php");
}








?>