<?php
include('./actions/customer.read.service.php');
include('./actions/item.read.service.php');
include('./actions/order.read.service.php');
include('./actions/orderDetails.read.service.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Axios Order Form - Activity 1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./assets/axios.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link href="./main.css" rel="stylesheet">
</head>

<body>
    <nav role="navigation">
        <div class="d-flex">
            <img src="./assets/axios.png" alt="Axios Logo" />
            <div class="nav-text-header">
                <h3>Axios</h3>
                <p>Order Manager</p>
            </div>
        </div>
        <div class="nav-pull-right">
            <ul>
                <li><a href="/activity-4-nograles/">Home</a></li>
                <li><a class="active" href="#">Shop</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div role="page body content" class="page-body">
        <div class="card page-banner">
            <h1>Admin Panel</h1>
            <p>Track and organize your system</p>
        </div>
        <div id="customerForm" class="card">
            <div id="wb-ie11-append-dis" class="card-header d-flex mb-2">
                <div class="card-item-left">
                    <img src="./assets/axios.png" alt="Axios Logo" />
                    <div class="card-item-text-header">
                        <h3>Axios</h3>
                        <p>Customer Data List</p>
                    </div>
                </div>
                <div id="wb-ie11-append-pos" class="card-item-right">
                    <p>Date: <span><?php echo date("Y/m/d") ?></span></p>
                </div>
            </div>
            <?php
            if ($_GET['prc'] === 'true') {
                echo "<div id='alert-message' class='success'>
                            <div class='d-flex d-flex-end'>
                                <p>User successfully delete!</p>
                                <button class='d-flex-end' onclick='closeAlert()'>Close</button>
                            </div>
                        </div>";
            }
            ?>
            <table class="blueTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer number</th>
                        <th>Customer name</th>
                        <th>Home address</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- table footer tab -->
                <tbody>
                    <!-- quest comes from an included file -->
                    <?php
                    if ($checkResult > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['customerNumber'] . "</td>";
                            echo "<td>" . $row['customerName'] . "</td>";
                            echo "<td>" . $row['homeAddress'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['mobileNumber'] . "</td>";
                            echo "<td>" . '<a href="actions/delete.customer.php?id=' . $row['id'] . '" class="delete-btn">Delete</a>' . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="customerForm" class="card">
            <div id="wb-ie11-append-dis" class="card-header d-flex mb-2">
                <div class="card-item-left">
                    <img src="./assets/axios.png" alt="Axios Logo" />
                    <div class="card-item-text-header">
                        <h3>Axios</h3>
                        <p>Product Data List</p>
                    </div>
                </div>
                <div id="wb-ie11-append-pos" class="card-item-right">
                    <p>Date: <span><?php echo date("Y/m/d") ?></span></p>
                </div>
            </div>
            <?php
            if ($_GET['itemDel'] === 'true') {
                echo "<div id='alert-message' class='success'>
                            <div class='d-flex d-flex-end'>
                                <p>Item successfully delete!</p>
                                <button class='d-flex-end' onclick='closeAlert()'>Close</button>
                            </div>
                        </div>";
            }

            if ($_GET['create'] === 'success') {
                echo "<div id='alert-message' class='success'>
                            <div class='d-flex d-flex-end'>
                                <p>Item created successfully!</p>
                                <button class='d-flex-end' onclick='closeAlert()'>Close</button>
                            </div>
                        </div>";
            }
            ?>
            <table class="blueTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item code</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- table footer tab -->
                <tbody>
                    <!-- quest comes from an included file -->
                    <button id="myBtn" class="btn-success">
                        Add item
                    </button>
                    <?php
                    if ($item_checkResult > 0) {
                        while ($row = mysqli_fetch_assoc($item_result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['itemCode'] . "</td>";
                            echo "<td> Php " . $row['price'] . "</td>";
                            echo "<td>" . $row['invtQuantity'] . "</td>";
                            echo "<td>" . $row['itemDescription'] . "</td>";
                            echo "<td>" . $row['itemName'] . "</td>";
                            echo "<td>" . '<a href="actions/item.delete.service.php?id=' . $row['id'] . '" class="delete-btn">Delete</a>' . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <form class="mt-2" action="./actions/item.insert.service.php" method="POST">
                    <h3>Add new item</h3>
                    <div id="root-msg"></div>
                    <div class="input-group">
                        <div class="input-holder">
                            <label>Item name<span class="required"> *</span></label>
                            <input id="itemName" name="itemName" type="text" class="input-field" autocomplete="off" required />
                        </div>
                        <div class="input-holder">
                            <label>Item Code<span class="required"> *</span></label>
                            <input id="itemCode" name="itemCode" type="number" class="input-field" autocomplete="off" required />
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-holder">
                            <label>Price<span class="required"> *</span></label>
                            <input id="price" name="price" type="number" class="input-field" autocomplete="off" required />
                        </div>
                        <div class="input-holder">
                            <label>Stock<span class="required"> *</span></label>
                            <input id="stock" name="stock" type="number" class="input-field" autocomplete="off" required />
                        </div>
                    </div>
                    <div class="input-holder">
                        <label>Description<span class="required"> *</span></label>
                        <textarea name="desc" class="input-field" rows="4" cols="50" required></textarea>
                    </div>
                    <button type="submit" class="btn-success">Create</button>
                </form>
            </div>
        </div>

        <div id="customerForm" class="card">
            <div id="wb-ie11-append-dis" class="card-header d-flex mb-2">
                <div class="card-item-left">
                    <img src="./assets/axios.png" alt="Axios Logo" />
                    <div class="card-item-text-header">
                        <h3>Axios</h3>
                        <p>Product Data List</p>
                    </div>
                </div>
                <div id="wb-ie11-append-pos" class="card-item-right">
                    <p>Date: <span><?php echo date("Y/m/d") ?></span></p>
                </div>
            </div>
            <?php
            if ($_GET['orderDel'] === 'true') {
                echo "<div id='alert-message' class='success'>
                            <div class='d-flex d-flex-end'>
                                <p>Order successfully delete!</p>
                                <button class='d-flex-end' onclick='closeAlert()'>Close</button>
                            </div>
                        </div>";
            }
            ?>
            <table class="blueTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Number</th>
                        <th>Order Number</th>
                        <th>Order Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- table footer tab -->
                <tbody>
                    <!-- quest comes from an included file -->
                    <button id="myBtn" class="btn-success">
                        Add item
                    </button>
                    <?php
                    if ($order_checkResult > 0) {
                        while ($row = mysqli_fetch_assoc($order_result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['customerNumber'] . "</td>";
                            echo "<td> Php " . $row['orderNumber'] . "</td>";
                            echo "<td>" . $row['orderDate'] . "</td>";
                            echo "<td> Php" . $row['orderAmount'] . "</td>";
                            echo "<td>" . '<a href="actions/order.delete.service.php?id=' . $row['id'] . '" class="delete-btn">Delete</a>' . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="customerForm" class="card">
            <div id="wb-ie11-append-dis" class="card-header d-flex mb-2">
                <div class="card-item-left">
                    <img src="./assets/axios.png" alt="Axios Logo" />
                    <div class="card-item-text-header">
                        <h3>Axios</h3>
                        <p>Product Data List</p>
                    </div>
                </div>
                <div id="wb-ie11-append-pos" class="card-item-right">
                    <p>Date: <span><?php echo date("Y/m/d") ?></span></p>
                </div>
            </div>
            <?php
            if ($_GET['orderDetailsDel'] === 'true') {
                echo "<div id='alert-message' class='success'>
                            <div class='d-flex d-flex-end'>
                                <p>Order details successfully delete!</p>
                                <button class='d-flex-end' onclick='closeAlert()'>Close</button>
                            </div>
                        </div>";
            }
            ?>
            <table class="blueTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Number</th>
                        <th>Item Code</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- table footer tab -->
                <tbody>
                    <!-- quest comes from an included file -->
                    <button id="myBtn" class="btn-success">
                        Add item
                    </button>
                    <?php
                    if ($orderD_checkResult > 0) {
                        while ($row = mysqli_fetch_assoc($orderD_result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['orderNumber'] . "</td>";
                            echo "<td>" . $row['itemCode'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . '<a href="actions/orderDetails.delete.service.php?id=' . $row['id'] . '" class="delete-btn">Delete</a>' . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer role="page footer">All rights reserve &copy; 2020 Axios Purchasing Corporation</footer>
    <!-- script -->
    <script>
        // variables
        // -- inputs
        var customerName = document.getElementById('customerName')
        var address = document.getElementById('address')
        var contactName = document.getElementById('contactName')
        var telNum = document.getElementById('telNum')
        var mobileNum = document.getElementById('mobileNum')
        var email = document.getElementById('email')

        // -- form
        var customerForm = document.getElementById('customerForm')
        var root = document.getElementById('root-msg')

        // special script to check the browser type -- result - iE11
        var isIE = /*@cc_on!@*/ false || !!document.documentMode;

        if (isIE) {
            var elementDis = document.getElementById('wb-ie11-append-dis')
            var elementPos = document.getElementById('wb-ie11-append-pos')

            elementDis.classList.add('ie11-append-dis')
            elementPos.classList.add('ie11-append-pos')
        }

        function checkIfEmpty(value) {
            if (value !== '') return true
            return false
        }

        // discard function
        function discardPurchase() {
            customerName.value = ''
            address.value = ''
            contactName.value = ''
            telNum.value = ''
            mobileNum.value = ''
            email.value = ''

            // scroll upward to forms
            // clear form
            customerForm.scrollIntoView(true)
            root.innerHTML = ''
            root.classList.remove('error')
            root.classList.remove('success')
        }

        // try to purchase item
        function sendPurchase() {
            // check inputs if it is not filled up
            var hasCustomerName = checkIfEmpty(customerName.value)
            var hasTelNum = checkIfEmpty(telNum.value)
            var hasMobileNum = checkIfEmpty(mobileNum.value)
            var hasEmail = checkIfEmpty(email.value)

            if (!hasCustomerName && !hasTelNum && !hasMobileNum && !hasEmail) {
                root.innerHTML = 'Oops! Please check your credential in order to proceed.'
                root.classList.add('error');
                // Add a class to the input field
                customerName.classList.add('input-err')
                mobileNum.classList.add('input-err')
                telNum.classList.add('input-err')
                email.classList.add('input-err')
                // scroll to the top form
                customerForm.scrollIntoView(true);
            } else {
                root.innerHTML = 'Hooray! Your purchase has been submitted.'
                root.classList.remove('error');
                root.classList.add('success');
                // remove input error
                customerName.classList.remove('input-err')
                mobileNum.classList.remove('input-err')
                telNum.classList.remove('input-err')
                email.classList.remove('input-err')
                // scroll to the top form
                customerForm.scrollIntoView(true);
            }
        }

        function closeAlert() {
            const alertItem = document.getElementById('alert-message');
            alertItem.classList.add('d-none');
        }

        // Get the modal
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>