<!-- <?php session_start(); ?> -->
<nav class="navbar navbar-expand-lg navbar-light white" style="position: fixed; width: 100%;z-index: 20;">
  <a class="navbar-brand" href="checkproduct.php">
    <img src="images/product.jpg" style="width: 30px;"> &nbsp
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color: #4287f5;"></span>
  </button>

  <div class="collapse navbar-collapse" id="basicExampleNav">
    <ul class="navbar-nav mr-auto">

      <?php
    if ($_SESSION['role'] == 1) {
    ?>
      <li class="nav-item">
        <a class="nav-link" href="#">Create Order</a>
      </li>
      <?php
    }
    if ($_SESSION['role'] == 2) {
    ?>
      <li class="nav-item">
        <a class="nav-link" href="buyproduct.php">Buy Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="checkproduct.php">Check Product Status</a>
      </li>
      <?php
    }
    if ($_SESSION['role'] == 3) {
    ?>
      <li class="nav-item">
        <a class="nav-link" href="addproduct.php">Add Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Update Order Status</a>
      </li>
      <?php
    }
    if ($_SESSION['role'] == 4 || $_SESSION['role'] == 5 || $_SESSION['role'] == 6 || $_SESSION['role'] == 7 || $_SESSION['role'] == 8) {
    ?>
      <li class="nav-item">
        <a class="nav-link" href="#">Update Order Status</a>
      </li>
      <?php
    }
    ?>
    </ul>
    <span class="nav-link">Welcome <?php echo $_SESSION['username']; ?></span>
    <form class="form-inline">
      <div class="md-form my-0">
        
        <a class="nav-link" href="logout.php" style="padding-left:5px;padding-right:5px;margin-left:0px;"> Logout </a>
      </div>
    </form>

  </div>
</nav>