<?php
    include('dbCon.php');

    $qs_item = "SELECT * FROM items;";
    $item_result = mysqli_query($connect, $qs_item);
    $item_checkResult = mysqli_num_rows($item_result);

?>