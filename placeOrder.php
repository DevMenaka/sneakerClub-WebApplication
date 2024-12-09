<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>SneakerClub | Checkout</title>
   <link rel="stylesheet" href="css/bootstrap.css" />
   <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
   <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body id="body">
   <section>
      <div class="container">
         <?php require "header.php";
         $obj = json_decode($_GET["idata"]);
         $od_rs = Database::search("SELECT * FROM `items` WHERE id='" . $obj->pid . "'");
         $odata = $od_rs->fetch_assoc();

         $address_rs = Database::search("SELECT * FROM `member_has_adress` INNER JOIN `city` ON
                member_has_adress.city_id=city.id INNER JOIN `district` ON 
                city.district_id=district.id INNER JOIN `province` ON  
                district.province_id=province.id WHERE `member_mail`='" . $data["email"] . "'");

         $address_data = $address_rs->fetch_assoc();
         ?>
         <div class="row">
            <div class="col-md-12">
               <div class="content">
                  <h1 class="page-name">Order Summary</h1>
                  <ol class="breadcrumb">
                     <li><a href="checkout.php">Coustemer Details</a></li>
                     <li class="active">Place Order</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
   </section>
   <div class="page-wrapper">
      <div class="checkout shopping">
         <div class="container">
            <div class="row">

               <div class="col-md-10">
                  <div class="product-checkout-details" id="sbox">
                     <div class="block ">
                        <h4 class="widget-title">Order Summary</h4>
                        <div class="media product-card">
                           <div class="media-body">
                              <div class="col-10">
                                 <div class="row">
                                    <div class="col-2 text-center">
                                       <span>Item:</span>
                                    </div>
                                    <div class="col-8 text-end">
                                       <span><?php echo $odata["title"] ?></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-10 mt-1">
                                 <div class="row">
                                    <div class="col-2 text-center">
                                       <span>Unit Price:</span>
                                    </div>
                                    <div class="col-8 text-end">
                                       <span>$<?php echo $odata["price"] ?></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-10 mt-1">
                                 <div class="row">
                                    <div class="col-2 text-center">
                                       <span>Quntity:</span>
                                    </div>
                                    <div class="col-8 text-end">
                                       <span><?php echo $obj->qty; ?></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-10 mt-4">
                                 <div class="row">
                                    <div class="col-2 text-center">
                                       <span>Subtotal:</span>
                                    </div>
                                    <div class="col-2 text-center bg-warning">
                                       <span>$<?php echo $odata["price"] ?> X <?php echo $obj->qty; ?></span>
                                    </div>
                                    <div class="col-6 text-end">
                                       <span>$<?php echo $odata["price"] * $obj->qty ?></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="discount-code"> </div>
                        <ul class="summary-prices">
                           <li>
                              <span>Subtotal:</span>
                              <span class="price">$<?php echo $odata["price"] * $obj->qty ?></span>
                           </li>
                           <li>
                              <?php
                              $shiping = 0;
                              $mha_rs = Database::search("SELECT*FROM `member_has_adress` 
                             WHERE `member_mail`='" . $data["email"] . "'");
                              $mha_data = $mha_rs->fetch_assoc();
                              if ($mha_data["district_id"] == 1) {
                                 $shiping = $odata["delevery_fee_colombo"];
                              } else {
                                 $shiping = $odata["delever_fee_other"];
                              }
                              ?>
                              <span>Shipping:</span>
                              <span id="dfee"><?php echo $shiping; ?></span>
                           </li>
                        </ul>
                        <div class="summary-total border-bottom border-success">
                           <span>Total</span>
                           <span>$<?php echo $odata["price"] * $obj->qty + $shiping ?></span>
                        </div>
                        <div class=" mt-5 col-12">
                           <img src="images/shop/verified.png" style="height:60px;">
                        </div>
                        <div class="block">
                           <div class="checkout-product-details">
                              <div class="payment">
                                 <div class="card-details">
                                    <?php
                                    $Itemobj = new stdClass();
                                    $Itemobj->pid = $obj->pid;
                                    $Itemobj->title = $odata["title"];
                                    $Itemobj->qty = $obj->qty;
                                    $Itemobj->total = $odata["price"] * $obj->qty + $shiping;
                                    $Itemobj->user = $data["email"];
                                    $Itemobj->orderId = uniqid();;
                                    $orderdata = json_encode($Itemobj);
                                    ?>

                                    <form  action="create-checkout-session.php" method="post">
                                       <input type="hidden" value='<?php echo($orderdata);?>' name="jsonData">
                                       <button class="btn btn-main mt-20" type="submit">Place Order</button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

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
   <script src="https://js.stripe.com/v3/"></script>
</body>

</html>