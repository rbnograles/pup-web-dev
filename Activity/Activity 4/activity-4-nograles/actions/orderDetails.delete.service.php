<?php
    include "dbCon.php"; 

    $id = $_GET['id']; 
    $del = mysqli_query($connect,"delete from orderdetails where id = '$id'"); 

    if($del) {
        mysqli_close($connect); 
        header("location:../admin.php?orderDetailsDel=true"); 
        exit;	
    } else {
        echo "Error deleting record"; 
    }
?>