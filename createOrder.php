<?php
session_start();
$color = "navbar-light orange darken-4";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="images/product.jpg" type="image/x-icon" />
    <link rel="ICON" href="images/product.jpg" type="image/ico" />

    <title>Buy Products</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <style>
        table tr {
            border: 0.5px solid black;
            text-align: center;
        }

        table tr td {
            border: 0.5px solid black;
        }

        table tr th {
            border: 0.5px solid black;
        }
    </style>

</head>
<?php
if ($_SESSION['role'] == 1) {
?>

<body class="violetgradient">
    <?php
    include 'navbar.php';
    include 'connectdb.php';
    ?>

    <div class="bgrolesadd">
        <center>
            <div class="mycardstyle" style="width:75%">
                <div class="greyarea">
                    <h5> Pending Orders </h5>
                    <br>
                    <form id="form1" autocomplete="off">
                        <div>

                            <table style="table-layout:fixed; width:100%;'">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer ID</th>
                                    <th>Product ID</th>
                                    <th>Product Price</th>
                                    <th>Quantity</th>
                                    <th></th>
                                    
                                </tr>
                                <?php
                                    $conn = openConnection();
                                    $result = mysqli_query($conn, "SELECT * FROM orders order by cid;");
                                    $i=0;
                                    while ($orders = mysqli_fetch_array($result)) {
                                        echo "<form method='get' action='buyproduct.php'>";
                                            echo "<tr>";
                                            $pid = $orders['pid'];
                                            $orderID = 'order'.$i;
                                            $cidID = 'cid'.$i;
                                            $pidID = 'pid'.$i;
                                            $priceID = 'price'.$i;
                                            $quantityID = 'quantity'.$i;
                                            $btnID = 'set'.$i;
                                            $price = mysqli_fetch_array(mysqli_query($conn,"SELECT MRP FROM PRODUCTS WHERE pid='$pid';"))['MRP'];
                                        if (!$orders['orderID']) {
                                            echo "<td id='$orderID'></td>";
                                            echo "<td id='$cidID'>".$orders['cid']."</td><td id='$pidID'>".$pid."</td><td id='$priceID'>".$price."</td><td id=' $quantityID'>".$orders['product_quantity']."</td>";
                                            echo "<td><input type='submit' id='$btnID' onclick='setOrder($i)' value='Set Order'></td>";  
                                        }
                                        else {                 
                                            echo "<td id='$orderID'>.".$orders['orderID']."</td>";
                                            echo "<td id='$cidID'>".$orders['cid']."</td><td id='$pidID'>".$pid."</td><td id='$priceID'>".$price."</td><td id=' $quantityID'>".$orders['product_quantity']."</td>";
                                            echo "<td><input type='submit' id='$btnID' onclick='setFlow($i)' value='Set Order Flow'></td>";
                                        }
                                        echo "</tr></form>";
                                        $i++;
                                    }
                                ?>
                            </table>
                        </div>
                        <button class="formbtn" id="mansub" type="button">Send Out Orders</button>
                    </form>
                </div>
            </div>


        </center>
        <?php
} else {
    include 'redirection.php';
    redirect('index.php');
}
        ?>
        <div class='box'>
            <div class='wave -one'></div>
            <div class='wave -two'></div>
            <div class='wave -three'></div>
        </div>
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Material Design Bootstrap-->
        <script type="text/javascript" src="js/popper.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/mdb.min.js"></script>

        <!-- Web3.js -->
        <script src="web3.min.js"></script>

        <script src="abi.js"></script>

        <!-- Web3 Injection -->
        <script>
            // Initialize Web3
            if (typeof web3 !== 'undefined') {
                web3 = new Web3(Web3.currentProvider);
                web3 = new Web3(new Web3.providers.HttpProvider('http://localhost:8545'));
            } else {
                web3 = new Web3(new Web3.providers.HttpProvider('http://localhost:8545'));
            }

            // Set the Contract
            var contract = new web3.eth.Contract(inventory_tracking_ABI, managerAddress);

            function setOrder(n) {
                var orderidID = 'order'+n;
                var cidID = 'cid' + n;
                var pidID = 'pid' + n;
                var priceID = 'price' + n;
                var quantityID = 'quantity' + n;
                var pid = document.getElementById(pidID).innerHTML;
                var cid = document.getElementById(cidID).innerHTML;
                var quantity = Number(document.getElementById(quantityID).innerHTML);
                var total_cost = Number(document.getElementById(priceID).innerHTML)*quantity;

            }
            //reading value from a smart contract
            contracts.methods.setOrder(pid,cid,quantity,total_cost).call(function (err, res) {
                if (err) {
                console.log("An error occured", err);
                return;
                }
                console.log("The OrderID is: ", res);
                document.getElementById(orderidID).innerHTML = res;
            });

            $('#form1').on('submit', function (event) {
                event.preventDefault(); // to prevent page reload when form is submitted
                prodname = $('#prodname').val();
                username = $('#user').val();
                prodname = prodname + "<br>Registered By: " + username;
                console.log(prodname);
                var today = new Date();
                var thisdate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                web3.eth.getAccounts().then(async function (accounts) {
                    var receipt = await contract.methods.newItem(prodname, thisdate).send({ from: accounts[0], gas: 1000000 })
                        .then(receipt => {
                            var msg = "<h5 style='color: #53D769'><b>Item Added Successfully</b></h5><p>Product ID: " + receipt.events.Added.returnValues[0] + "</p>";
                            qr.value = receipt.events.Added.returnValues[0];
                            $bottom = "<p style='color: #FECB2E'> You may print the QR Code if required </p>";
                            $("#alertText").html(msg);
                            $("#qrious").show();
                            $("#bottomText").html($bottom);
                            $(".customalert").show("fast", "linear");
                        });
                    //console.log(receipt);
                });
                $("#prodname").val('');

            });

            $('#form2').on('submit', function (event) {
                event.preventDefault(); // to prevent page reload when form is submitted
                prodid = $('#prodid').val();
                prodlocation = $('#prodlocation').val();
                console.log(prodid);
                console.log(prodlocation);
                var today = new Date();
                var thisdate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                var info = "<br><br><b>Date: " + thisdate + "</b><br>Location: " + prodlocation;
                web3.eth.getAccounts().then(async function (accounts) {
                    var receipt = await contract.methods.addState(prodid, info).send({ from: accounts[0], gas: 1000000 })
                        .then(receipt => {
                            var msg = "Item has been updated ";
                            $("#alertText").html(msg);
                            $("#qrious").hide();
                            $("#bottomText").hide();
                            $(".customalert").show("fast", "linear");
                        });
                });
                $("#prodid").val('');
                $("#prodlocation").val('');
            });


            function isInputNumber(evt) {
                var ch = String.fromCharCode(evt.which);
                if (!(/[0-9]/.test(ch))) {
                    evt.preventDefault();
                }
            }

            (function () {
                var qr = window.qr = new QRious({
                    element: document.getElementById('qrious'),
                    size: 200,
                    value: '0'
                });


            })();

            function showAlert(message) {
                $("#alertText").html(message);
                $("#qrious").hide();
                $("#bottomText").hide();
                $(".customalert").show("fast", "linear");
            }

        </script>
</body>

</html>