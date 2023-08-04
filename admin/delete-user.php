<?php

include 'config.php';
if($_SESSION['user_role'] == '0'){

    header("Location: {$header}/admin/post.php");

 }

$user_id = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = '{$user_id}'";

if(mysqli_query($conn, $sql)) {
    header("Location: {$header}/admin/users.php");
}else{
    echo "<span>Can't Delete the user Record.</span>";
}


mysqli_close($conn);





?>