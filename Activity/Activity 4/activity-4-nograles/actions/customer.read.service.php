<?php
    include('dbCon.php');

    $qs_customer = "SELECT * FROM customer;";
    $result = mysqli_query($connect, $qs_customer);
    $checkResult = mysqli_num_rows($result);

?>