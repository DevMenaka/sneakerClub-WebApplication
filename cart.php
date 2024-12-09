<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>SneakerClub | Cart</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="body">
  <?php
  require "connection.php";
  $email = $_GET["e"];
  $total = 0;

  $crs = Database::search("SELECT * FROM `cart` WHERE `user_mail`='" . $email . "'");
  $cnum = $crs->num_rows;
  ?>
  <section>
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <div class="content">
            <h1 class="page-name">Cart</h1>
            <ol class="breadcrumb">
              <li><a href="home.php">Home</a></li>
              <li class="active">cart</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  if ($cnum == 0) {

  ?>
    <section class="empty-cart page-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="block text-center">
              <i class="tf-ion-ios-cart-outline"></i>
              <h2 class="text-center">Your cart is currently empty.</h2>
              <a href="home.php" class="btn btn-main mt-20">Return to shop</a>
            </div>
          </div>
        </div>
    </section>
  <?php
  } else {
  ?>
    <div class="page-wrapper">
      <div class="cart shopping">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="block">
                <div class="product-list">
                  <form method="post">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="">Item Name</th>
                          <th class="">Item Price</th>
                          <th class="">Quntity</th>
                          <th class="">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        for ($z = 0; $z < $cnum; $z++) {
                          $cdata = $crs->fetch_assoc();
                        ?>
                          <tr class="">
                            <td class="">
                              <div class="product-info">
                                <?php $img_rs = Database::search("SELECT * FROM `images` WHERE `items_id`='" . $cdata["item_id"] . "'");
                                $imgData = $img_rs->fetch_assoc();
                                ?>
                                <img width="80" src="<?php echo $imgData["path"] ?>" />
                                <?php $irs = Database::search("SELECT * FROM `items` WHERE `id`='" . $cdata["item_id"] . "'");
                                $iData = $irs->fetch_assoc();
                                ?>
                                <p class="text-start"><a href="#!"><?php echo $iData["title"] ?></a></p>
                              </div>
                            </td>
                            <td class="">$<?php echo $iData["price"]; ?></td>
                            <td class=""><?php echo $cdata["cart_qty"]; ?></td>
                            <td class="">
                              <a class="product-remove" style="cursor:pointer;" onclick="deletFromCart(<?php echo $cdata['id']; ?>)">Remove</a>
                            </td>
                          </tr>
                        <?php
                        $total = $total + ($iData["price"] * $cdata["cart_qty"]);
                        } ?>

                      </tbody>
                    </table>
                    <div class="col-12">
                      <div class="row justify-content-center">

                        <div class="col-6 p-2 bg-light">
                          <div class="col-12">
                            <div class="row">
                              <div class="col-4">
                                <span class="text-center text-dark fw-bold fs-2">Total :</span>
                              </div>
                              <div class="col-4 mt-1">
                                <span class="text-end fs-3">$<?php echo $total;?></span>
                              </div>
                              <div class="col-4 mt-1 ">
                                <span class="text-end fs-4 text-primary">+ Shipping Fee</span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-5">
                          <a href="" class="btn btn-main pull-right">Checkout</a>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  <?php
  }
  ?>

  <footer class="footer section text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="social-media">
            <li>
              <a href="https://www.facebook.com/themefisher">
                <i class="tf-ion-social-facebook"></i>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/themefisher">
                <i class="tf-ion-social-instagram"></i>
              </a>
            </li>
            <li>
              <a href="https://www.twitter.com/themefisher">
                <i class="tf-ion-social-twitter"></i>
              </a>
            </li>
            <li>
              <a href="https://www.pinterest.com/themefisher/">
                <i class="tf-ion-social-pinterest"></i>
              </a>
            </li>
          </ul>
          <ul class="footer-menu text-uppercase">
            <li>
              <a href="contact.html">CONTACT</a>
            </li>
            <li>
              <a href="shop.html">SHOP</a>
            </li>
            <li>
              <a href="pricing.html">Pricing</a>
            </li>
            <li>
              <a href="contact.html">PRIVACY POLICY</a>
            </li>
          </ul>
          <p class="copyright-text">Copyright &copy;2021, Designed &amp; Developed by <a href="https://themefisher.com/">Themefisher</a></p>
        </div>
      </div>
    </div>
  </footer>

<script src="script.js"></script>
</body>

</html>