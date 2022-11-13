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
if ($_SESSION['role'] == 2) {
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
                    <h5> Products Available for purchase </h5>
                    <form id="form1" autocomplete="off">
                        <div>

                            <table style="table-layout:fixed; width:100%;'">
                                <tr>
                                    <th style='width:10%;'>Product ID</th>
                                    <th style='width:20%;'>Product Name</th>
                                    <th style='width:35%;'>Product Description</th>
                                    <th style='width:15%;'>Product Price</th>
                                    <th style='width:10%;'>Quantity</th>
                                    <th style='width:10%;'></th>
                                </tr>
                                <?php
                                    $conn = openConnection();
                                    $result = mysqli_query($conn, "SELECT * FROM PRODUCTS order by pid;");
                                    $i = 0;
                                    $_SESSION['pids'] = array();
                                    while ($prod_info = mysqli_fetch_array($result)) {
                                        echo "<form method='get' action='buyproduct.php'>";
                                        echo "<tr>";
                                        $pid = $prod_info['pid'];
                                        $quantityID = 'quantity' . $i;
                                        $btnID = 'buy' . $i;
                                        array_push($_SESSION['pids'], $pid);
                                        echo "<td>" . $pid . "</td><td>" . $prod_info['name'] . "</td><td>" . $prod_info['description'] . "</td><td>Rp. " . $prod_info['MRP'] . "</td>";
                                        echo "<td><input name='$quantityID' type='number' style='width:80%'></td>";
                                        echo "<td><input type='submit' name='$btnID'value='Buy'></td>";
                                        echo "</tr></form>";
                                        $i++;
                                    }
                                
                                    $cid = $_SESSION['cid'];
                                    for ($k = 0; $k < $i; $k++) {
                                        $btn = "buy".$k;
                                        if (isset($btn) && isset($_GET['quantity'.$k])) {
                                            $pid = $_SESSION['pids'][$k];
                                            $quantity = $_GET['quantity'.$k];
                                            // echo $pid."<br>";
                                            // echo $quantity."<br><br>";
                                            $insertOrder = mysqli_query($conn,"INSERT INTO orders (cid,pid,product_quantity) VALUES ('$cid','$pid','$quantity');");
                                            if (!$insertOrder) {
                                                $getQuantity = mysqli_fetch_array(mysqli_query($conn,"SELECT product_quantity FROM orders WHERE pid='$pid' and cid='$cid';"))['product_quantity'];
                                                $quantity += $getQuantity;
                                                mysqli_query($conn,"DELETE FROM orders WHERE pid='$pid' and cid='$cid';");
                                                mysqli_query($conn,"INSERT INTO orders (cid,pid,product_quantity) VALUES ('$cid','$pid','$quantity');");
                                            }
                                            echo "<br><p style='color:red'>Order successfully placed for ".$quantity." of product ".$pid."</p><br>";
                                            
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                        <button class="formbtn" id="mansub" type="button"><a style='color:white;text-decoration:none;' href='checkproduct.php'>Finish ordering</a></button>
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

        <script src="app.js"></script>

        <!-- Web3 Injection -->
        <script>
            // Initialize Web3
            if (typeof web3 !== 'undefined') {
                web3 = new Web3(web3.currentProvider);
                web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
            } else {
                web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
            }

            // Set the Contract
            var contract = new web3.eth.Contract(contractAbi, contractAddress);



            $("#manufacturer").on("click", function () {
                $("#districard").hide("fast", "linear");
                $("#manufacturercard").show("fast", "linear");
            });

            $("#distributor").on("click", function () {
                $("#manufacturercard").hide("fast", "linear");
                $("#districard").show("fast", "linear");
            });

            $("#closebutton").on("click", function () {
                $(".customalert").hide("fast", "linear");
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