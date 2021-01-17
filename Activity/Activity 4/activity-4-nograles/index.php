<!-- connection string path to bd -->
<?php
include('./actions/item.read.service.php');

// this is for generating the options dynamically
$connect2 = new PDO("mysql:host=localhost;dbname=ordersystem", "root", "");
function fill_options($connect)
{
    $output = '';
    $query = "SELECT * FROM items";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output .= '<option value="' . $row["itemName"] . '">' . $row["itemName"] . '</option>';
    }
    return $output;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Axios Order Form - Activity 1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
                <li><a href="#">Home</a></li>
                <li><a class="active" href="#">Shop</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>
    <div role="page body content" class="page-body">
        <div class="card page-banner">
            <h1>Purchase Order Form</h1>
            <p>Customize your orders how ever you want</p>
        </div>
        <div id="customerForm" class="card">
            <div id="wb-ie11-append-dis" class="card-header d-flex mb-2">
                <div class="card-item-left">
                    <img src="./assets/axios.png" alt="Axios Logo" />
                    <div class="card-item-text-header">
                        <h3>Axios</h3>
                        <p>Customer Information Card</p>
                    </div>
                </div>
                <div id="wb-ie11-append-pos" class="card-item-right">
                    <p>Order No.: <span>1024-XXX1</span></p>
                    <p>Order Date: <span>October 26, 2020</span></p>
                </div>
            </div>
            <hr />
            <form class="mt-2" action="./actions/customer.order.service.php" method="POST">
                <div id="root-msg"></div>
                <div class="input-holder">
                    <label>Customer Name<span class="required"> *</span></label>
                    <input id="customerName" name="customerName" type="text" class="input-field" autocomplete="off" />
                </div>
                <div class="input-holder">
                    <label>Address</label>
                    <input id="address" name="address" type="text" class="input-field" autocomplete="off" />
                </div>
                <div class="input-group">
                    <div class="input-holder">
                        <label>Email<span class="required"> *</span></label>
                        <input id="telNum" name="email" type="email" class="input-field" autocomplete="off" />
                    </div>
                    <div class="input-holder">
                        <label>Mobile No.<span class="required"> *</span></label>
                        <input id="mobileNum" name="mobileNum" type="text" class="input-field" autocomplete="off" />
                    </div>
                </div>

                <h2 class="mb-2">Products to Order</h2>
                <div class="table-container">
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Stock Number</th>
                                <th>Product Code</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- table footer tab -->
                        <tbody id="tbody">
                            <tr>
                                <td>
                                    <select id="select-evnt" class='table-select' name='unit[]' id='unit'>
                                        <option value='' selected>Select an item</option>
                                        <?php
                                        if ($item_checkResult > 0) {
                                            while ($row = mysqli_fetch_assoc($item_result)) {
                                                echo '<option value="' . $row['itemName'] . '">' . $row['itemName'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input id="itemNum" name="itemNum[]" type="number" class="table-input" placeholder="Number of items" /></td>
                                <td id="stockNum">-</td>
                                <td id="prdCode">-</td>
                                <td id="desc">-</td>
                                <td id="price" class="r-align">&#8369; -</td>
                                <td class="remove"><button class="btn-canceled">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn-success add mt-2" name="add">Add item</button>
                </div>

                <div class="d-flex mt-2">
                    <div class="input-holder">
                        <label>Grand Total</label>
                        <input type="number" class="input-field" value="" placeholder="----.--" readonly />
                    </div>
                    <div class="btn-group">
                        <button class="btn-canceled" onclick="discardPurchase()">Discard</button>
                        <button type="submit" name="submit" class="btn-success">Purchase</button>
                    </div>
                </div>
            </form>
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
        var items = 0;

        if (isIE) {
            var elementDis = document.getElementById('wb-ie11-append-dis')
            var elementPos = document.getElementById('wb-ie11-append-pos')

            elementDis.classList.add('ie11-append-dis')
            elementPos.classList.add('ie11-append-pos')
        }

        // upon submiting ang redirection of a response from the php file
        window.addEventListener('load', function() {
            var url_string = window.location.href
            var url = new URL(url_string);
            var success = url.searchParams.get("order")
            if (success) {
                root.innerHTML = 'Hooray! Your purchase has been submitted.'
                root.classList.remove('error');
                root.classList.add('success');
            }
        });

        $(document).ready(function() {

            $(document).on('click', '.add', function() {
                var html = '';
                html += '<tr>';
                html += '<td><select id="select-evnt" class="table-select" name="unit[]"><option value="">Select an item</option><?php echo fill_options($connect2); ?></select></td>';
                html += '<td><input type="text" name="itemNum[]" class="table-input" placeholder="Number of items" /></td>';
                html += '<td id="stockNum">-</td>';
                html += '<td id="prdCode">-</td>';
                html += '<td id="desc">-</td>';
                html += '<td id="price" class="r-align">&#8369; -</td>';
                html += '<td><button type="button" name="remove" class="btn-canceled remove">Remove</button></td></tr>';
                $('#tbody').append(html);
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });

            $(document).on('click', '#select-evnt', function() {
                let var1 = {};
                var1.data = document.getElementById('select-evnt').value;
                if (var1.data === '') return false;
                console.log(var1)
                $.ajax({
                    url: "./actions/readItemBy.php",
                    method: "post",
                    data: var1,
                    success: function(response) {
                        let stringLayer = JSON.parse(JSON.stringify(response));
                        let objectLayer = JSON.parse(stringLayer);
                        $('#stockNum').html(objectLayer[0].invtQuantity).removeAttr("id");
                        $('#prdCode').html(objectLayer[0].itemCode).removeAttr("id");
                        $('#desc').html(objectLayer[0].itemDescription).removeAttr("id");
                        $('#price').html("Php " + objectLayer[0].price).removeAttr("id");
                        $('#select-evnt').removeAttr('id');
                    }
                });
            });
        });


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
    </script>
</body>

</html>