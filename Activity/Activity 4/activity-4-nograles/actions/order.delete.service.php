<?php
    include "dbCon.php"; 

    $id = $_GET['id']; 
    $del = mysqli_query($connect,"delete from orders where id = '$id'"); 

    if($del) {
        mysqli_close($connect); 
        header("location:../admin.php?orderDel=true"); 
        exit;	
    } else {
        echo "Error deleting record"; 
    }
?>