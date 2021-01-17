<?php
    include "dbCon.php"; 

    $id = $_GET['id']; 
    $del = mysqli_query($connect,"delete from items where id = '$id'"); 

    if($del) {
        mysqli_close($connect); 
        header("location:../admin.php?itemDel=true"); 
        exit;	
    } else {
        echo "Error deleting record"; 
    }
?>
