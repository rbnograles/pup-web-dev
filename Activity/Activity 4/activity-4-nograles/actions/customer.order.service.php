<?php
    include('dbCon.php');

    if(isset($_POST["submit"])) {
        $customerNum = rand();
        $customerName = $_POST['customerName'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $mobileNum = $_POST['mobileNum'];

        $sql = "INSERT INTO `customer` (`customerNumber`, `customerName`, `homeAddress`, `email`, `mobileNumber`) VALUES ('$customerNum', '$customerName', '$address', '$email', '$mobileNum');";
        mysqli_query($connect, $sql);

        $invoiceID = mysqli_insert_id($connect);


        for($a = 0; $a < count($_POST["itemNum"]); $a++) {

            $get = "SELECT * FROM items WHERE itemName = '" . $_POST["unit"][$a]. "';";
            $item_result =  mysqli_query($connect, $get);
            $item_checkResult = mysqli_num_rows($item_result);
            $data = [];

            if ($item_checkResult > 0) {
                while ($row = mysqli_fetch_assoc($item_result)) {
                    $insertToOrderDetails = "INSERT INTO orderdetails (`orderNumber`, `itemCode`, `quantity`) VALUES ('$invoiceID', '" .$row["itemCode"] ."', '".$_POST["itemNum"][$a]."')";
                    $insertToOrders = "INSERT INTO orders (`customerNumber`, `orderNumber`, `orderAmount`) VALUES ('$customerNum', '$invoiceID', '".$_POST["itemNum"][$a] * $row["price"]."')";
                    mysqli_query($connect, $insertToOrderDetails);
                    mysqli_query($connect, $insertToOrders); 
                }
            }

           
        }
    }

    header("Location: ../index.php?order=success");

?>