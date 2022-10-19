<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Toys</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<?php
session_start();
include_once("connection.php");
?>

<body>
  <div class="container-fluid">
    <header id="header">
      <div id="logo"><img src="images/logo moon cakes.jpg" width="90" height="66" alt="Moon Cakes" /></div>
      <nav id="menu_top">
        <ul class="level1">
          <li><a href="Mid-Autum-Cakes.php">
              <h5>Home</h5>
            </a></li>
          <li><a href="?page=category_management">
              <h5>Management Category</h5>
            </a>
            <?php
						if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
						?>
							<li>
								<a href="?page=update_customer">
								<h5>Hi, <?php echo $_SESSION['us'] ?></h5>
								</a>
							</li>
							<li><a href="?page=logout"><h5>Logout</h5></a></li>
						<?php
						} else {
						?>
							<li><a href="?page=login"><h5>Login</h5></a></li>
							<li><a href="?page=register"><h5>Register</h5></a></li>
						<?php
						}
            ?>


          <li><a href="?page=product_management">
              <h5>Management Product</h5>
            </a>
          </li>

        </ul>
      </nav>
    </header>
    <?php
    if (isset(($_GET['page']))) {
      $page = $_GET['page'];
      if ($page == "register") {
        include_once("Register.php");
      } elseif ($page == "login") {
        include_once("LoginJS.php");
      } elseif ($page == "category_management") {
        include_once("Category_Management.php");
      } elseif ($page == "product_management") {
        include_once("Product_Management.php");
      } elseif ($page == "add_category") {
        include_once("Add_Category.php");
      } elseif ($page == "add_product") {
        include_once("Add_Product.php");
      } elseif ($page == "update_category") {
        include_once("Update_Category.php");
      } elseif ($page == "Update_Product") {
        include_once("Update_Product.php");
      } elseif ($page == "logout") {
        include_once("Logout.php");
      } elseif ($page == "update_customer") {
        include_once("Update_customer.php");
      }
    } else {
      include("Content.php");
    }
    ?>
  </div>
  <!-- Footer -->
  <footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social network:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Ldatttz Company
            </h6>
            <p>
            We will bring you the best experiences. Thank you for using our service.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Products
            </h6>
            <p>
              <a href="#!" class="text-reset">Angular</a>
            </p>
            <p>
              <a href="#!" class="text-reset">React</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Laravel</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Useful links
            </h6>
            <p>
              <a href="#!" class="text-reset">Pricing</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Settings</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Orders</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Help</a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

            <h6 class="text-uppercase fw-bold mb-4">
              Contact
            </h6>
            <p><i class="fas fa-home me-3"></i> Can Tho, Pham Ngu Lao</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              lamdat04052002@gmail.com
            </p>
            <p><i class="fas fa-phone me-3"></i> + 09 226 655 84</p>
            <p><i class="fas fa-print me-3"></i> + 09 226 655 84</p>
          </div>

        </div>

      </div>
    </section>
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2022 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Shop-Toys.com</a>
    </div>
  </footer>



</body>

</html>