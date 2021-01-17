<?php

    include "dbCon.php";
    $getItem = mysqli_query($connect, "SELECT * from items where itemName ='". $_POST["data"]."';");
    $check_ItemResult = mysqli_num_rows($getItem);
    $data =  [];
    if ($check_ItemResult > 0) {
        while ($row = mysqli_fetch_assoc($getItem)) {
            array_push($data, $row);
        }
    }

    $jsonData = json_encode($data);
    echo $jsonData;
?>