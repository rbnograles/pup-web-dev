<?php
    include('dbCon.php');

        $itemName = $_POST['itemName'];
        $itemCode = $_POST['itemCode'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $desc = $_POST['desc'];

        $insertItem = "INSERT INTO items (itemCode, price, invtQuantity, itemDescription, itemName) VALUES ('$itemCode', '$price', '$stock', '$desc', '$itemName')";
        mysqli_query($connect, $insertItem);
        header("Location: ../admin.php?create=success");
?>