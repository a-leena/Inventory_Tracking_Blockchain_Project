<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="SHORTCUT ICON" href="images/product.jpg" type="image/x-icon" />
  <link rel="ICON" href="images/product.jpg" type="image/ico" />

  <title>Decentralized Application</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

</head>

<body class="violetgradient">
  <?php
  //echo "The role is : ".$_SESSION['role']."<br>The username is: ".$_SESSION['username'];
  if (!isset($_SESSION['role'])) {
  ?>
  <center>
    <div class="customalert">
      <div class="alertcontent">
        <div id="alertText"> &nbsp </div>
        <img id="qrious">
        <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
        <button id="closebutton" class="formbtn"> OK </button>
      </div>
    </div>
  </center>
  <div style="width: 100%">
    <center>
      <div class="loginformcard" id="card1">
        <h4>Product Tracker</h4>
        <p style="max-width: 80%;">
          An autonomous decentralized system that records transactions between parties in a secure and permanent way,
          and solves the issue of transparency as the customer knows about all the entities involved and can monitor the
          processes involved in getting their product after they have placed an order.
          <br><br>
          Products from many different manufacturers are imported/shipped/transported and brought to distributors, who
          then supply them to either the consumers directly or to some retailers and retail chains. Either of these
          end-product-holders need to know the product status. That's where our website comes into the picture!
        </p>
        <div class="cardbtnarea">
          <button class="col-md-5 rolebtn" id="login">Login</button>
          <button class="col-md-5 rolebtn" id="signup">Signup</button>
        </div>
      </div>


      <div class="loginformcard" id="maincard3">
        <h4>Create your new account</h4>
        <form style="margin-top: 30px; margin-bottom: 30px;" action="registration.php" method="POST"
          onsubmit="return checkSecondForm(this);">

          <label type="text" class="formlabel"> Email </label>
          <input type="text" class="forminput" name="email" id="email" onkeypress="isNotChar(event)" required>

          <label type="text" class="formlabel" style="margin-top: 10px;"> Username </label>
          <input type="text" class="forminput" name="username" id="username" onkeypress="blockSpaces(event)" required>

          <label type="text" class="formlabel" style="margin-top: 10px;"> Password </label>
          <input type="password" class="forminput" name="pw" id="pw" onkeypress="isNotChar(event)" required>

          <label type="text" class="formlabel" style="margin-top: 10px;"> Confirm Password </label>
          <input type="password" class="forminput" name="cpw" id="cpw" onkeypress="isNotChar(event)" required>

          <label type="text" class="formlabel" style="margin-top:10px;"> Role </label>
          <select id="role" class="formselect" onclick="addAddress()" name="role" style="text-align:center">
            <option value="0">---Select Your Role---</option>
            <option value="1">Manager</option>
            <option value="2">Customer</option>
            <option value="3">Manufacturer</option>
            <option value="4">Land Transport</option>
            <option value="5">Customs</option>
            <option value="6">Port Authority</option>
            <option value="7">Shipment</option>
            <option value="8">Distributor</option>
          </select>
          <div id="addressInput">
            <label type="text" class="formlabel" style="margin-top: 10px;"> Address </label>
            <input type="text" name="address" id="address" placeholder="" class="forminput">
          </div>
          <button class="formbtn" name="loginsubmit" value="submitted!" type="submit">Register</button>

          <br>
          <a href="#" id="gotologin"> Already have an account? Login to your existing account </a>
        </form>
      </div>


      <div class="loginformcard" id="maincard2">
        <h4>Login to your existing account</h4>
        <form style="margin-top: 30px; margin-bottom: 30px;" action="login.php" method="POST"
          onsubmit="return checkFirstForm(this);">

          <label type="text" class="formlabel"> Email </label>
          <input type="text" class="forminput" name="email" id="email" onkeypress="isNotChar(event)" required>

          <label type="text" class="formlabel" style="margin-top: 10px;"> Password </label>
          <input type="password" class="forminput" name="pw" id="pw" onkeypress="isNotChar(event)" required>

          <button class="formbtn" name="submit" type="submit">Login</button>

          <br>
          <a href="#" id="gotosignup"> Don't have an account? Create a new account now</a>
        </form>

      </div>
    </center>
  </div>
  <?php
  } else {
    include 'redirection.php';
    //manager
    if ($_SESSION['role']==1) {
      redirect('createOrder.php');
    }
    //customer
    else if ($_SESSION['role']==2) {
      redirect('checkproduct.php');
    }
    //manufacturer
    else if ($_SESSION['role']==3) {
      redirect('addproduct.php');
    }
    //all other enities
    else {
      redirect('updateOrderStatus.php');
    }
  }
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- Material Design Bootstrap-->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script>

    function isInputNumber(evt) {
      var ch = String.fromCharCode(evt.which);
      if (!(/[0-9]/.test(ch))) {
        evt.preventDefault();
      }
    }
    function isNotChar(evt) {
      var ch = String.fromCharCode(evt.which);
      if (ch == "'") {
        evt.preventDefault();
      }
    }

    function blockSpaces(evt) {
      var ch = String.fromCharCode(evt.which);
      if (ch == "'" || ch == " ") {
        evt.preventDefault();
      }
    }

    function blockSpecialChar(e) {
      var k;
      document.all ? k = e.keyCode : k = e.which;
      return ((k >= 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 46 || k == 42 || k == 33 || k == 32 || (k >= 48 && k <= 57));
    }

    function addAddress() {
      var dropdown = document.getElementById("role");
      var val = dropdown.options[dropdown.selectedIndex].value;
      console.log(val);
      if (val=="3" || val=="4" || val=="5" || val=="6" || val=="7" || val=="8") {
        console.log("hello");
        document.getElementById("address").disabled = false;
        document.getElementById("address").required = true;
        document.getElementById("address").setAttribute("placeholder","");
      }
      if (val=="1" || val=="2") {
        document.getElementById("address").disabled = true;
        document.getElementById("address").required = false;
        document.getElementById("address").setAttribute("placeholder","0x0000000000000000000000000000000000000000");
      }
    }

    $("#login").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#gotologin").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#openlogin").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#signup").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").show("fast", "linear");
    });

    $("#gotosignup").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").show("fast", "linear");
    });

    $("#opensignup").on("click", function () {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").show("fast", "linear");
    });

    $("#closebutton").on("click", function () {
      $(".customalert").hide("fast", "linear");
    });

    function checkSecondForm(theform) {
      var email = theform.email.value;
      var pw = theform.pw.value;
      var cpw = theform.cpw.value;
      var dropdown = document.getElementById("role");
      var role_val = dropdown.options[dropdown.selectedIndex].value;
      if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
      }
      if (pw != cpw) {
        showAlert("Please check your password");
        return false;
      }
      if (role_val==0) {
        showAlert("Please select a role");
        return false;
      }

      return true;
    }

    function checkFirstForm(theform) {
      var email = theform.email.value;

      if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
      }
      return true;
    }

    function showAlert(message) {
      $("#alertText").html(message);
      $("#qrious").hide();
      $("#bottomText").hide();
      $(".customalert").show("fast", "linear");
    }

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

  </script>
</body>

</html>