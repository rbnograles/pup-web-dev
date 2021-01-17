<?php
    include('dbCon.php');

    $qs_orderD = "SELECT * FROM orderdetails;";
    $orderD_result = mysqli_query($connect, $qs_orderD);
    $orderD_checkResult = mysqli_num_rows($orderD_result);
?>