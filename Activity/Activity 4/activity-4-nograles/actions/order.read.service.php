<?php
    include('dbCon.php');

    $qs_order = "SELECT * FROM orders;";
    $order_result = mysqli_query($connect, $qs_order);
    $order_checkResult = mysqli_num_rows($order_result);
?>
