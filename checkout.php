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

         $address_rs = Database::search("SELECT * FROM `member_has_adress` INNER JOIN `city` ON
                member_has_adress.city_id=city.id INNER JOIN `district` ON 
                city.district_id=district.id INNER JOIN `province` ON  
                district.province_id=province.id WHERE `member_mail`='" . $data["email"] . "'");

         $address_data = $address_rs->fetch_assoc();
         ?>
         <div class="row">
            <div class="col-md-12">
               <div class="content">
                  <h1 class="page-name">Checkout</h1>
                  <ol class="breadcrumb">
                     <li><a href="singleProductView.php">Home</a></li>
                     <li class="active">checkout</li>
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

               <div class="col-md-12">
                  <div class="block billing-details">
                     <h4 class="widget-title">customer Details</h4>
                     <form class="checkout-form">
                        <div class="form-group">
                           <label for="full_name">First Name</label>
                           <input type="text" class="form-control" id="fname" value="<?php echo $data["fname"]; ?>" />
                        </div>
                        <div class="form-group">
                           <label for="full_name">Last Name</label>
                           <input type="text" class="form-control" id="lname" value="<?php echo $data["lname"]; ?>" />
                        </div>
                        <div class="checkout-country-code clearfix">
                           <div class="form-group">
                              <label for="user_post_code">Email</label>
                              <input type="text" class="form-control" value="<?php echo $data["email"]; ?>" id="email" disabled />
                           </div>
                           <div class="form-group">
                              <label for="user_post_code">Mobile</label>
                              <?php
                              $member_rs = Database::search("SELECT*FROM `members` WHERE `email`='" . $data["email"] . "'");
                              $mdata = $member_rs->fetch_assoc();
                              if (!empty($mdata["mobile"])) {
                              ?>
                                 <input type="text" class="form-control" id="mobile" value="<?php echo $mdata["mobile"]; ?>" />
                              <?php
                              } else {
                              ?>
                                 <input type="text" class="form-control" id="mobile" />
                              <?php
                              }
                              ?>

                           </div>
                        </div>
                        <div class="form-group">
                           <label for="user_address">Address Line 1</label>
                           <?php if (!empty($address_data["line1"])){
                              ?>
                              <input type="text" class="form-control" id="address1" value="<?php echo $address_data["line1"];?>"/>
                              <?php
                           }else{
                              ?>
                              <input type="text" class="form-control" id="address1" value="" />
                              <?php
                           }?>
                        </div>
                        <div class="form-group">
                           <label for="user_address">Address Line 2</label>
                           <?php if (!empty($address_data["line2"])){
                              ?>
                              <input type="text" class="form-control" id="address2" value="<?php echo $address_data["line2"];?>"/>
                              <?php
                           }else{
                              ?>
                              <input type="text" class="form-control" id="address2" value="" />
                              <?php
                           }?>
                        </div>
                        <div class="checkout-country-code clearfix">
                           <div class="form-group">
                              <label for="user_post_code">Zip Code</label>
                              <?php if (!empty($address_data["zip"])){
                              ?>
                              <input type="text" class="form-control" id="pcode" value="<?php echo $address_data["zip"];?>"/>
                              <?php
                           }else{
                              ?>
                              <input type="text" class="form-control" id="pcode" value="" />
                              <?php
                           }?>
                           </div>

                           <?php
                           $province_rs = Database::search("SELECT*FROM `province`");
                           $distric_rs = Database::search("SELECT*FROM `district`");
                           ?>

                           <div class="form-group">
                              <select class="form-control" id="province" style="height:50px;">
                                 <option value="0">Select Province</option>
                                 <?php
                                 $province_num = $province_rs->num_rows;
                                 for ($x = 0; $x < $province_num; $x++) {
                                    $province_data = $province_rs->fetch_assoc();
                                 ?>
                                    <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                          if (!empty($address_data["province_id"])) {

                                                                                             if ($province_data["id"] == $address_data["province_id"]) {
                                                                                          ?>selected<?php
                                                                                                   }
                                                                                                }
                                                                                                      ?>><?php echo $province_data["province_name"]; ?></option>
                                 <?php

                                 }
                                 ?>
                              </select>
                           </div>

                        </div>

                        <div class="checkout-country-code clearfix">

                           <div class="form-group">
                              <select class="form-control" id="district" style="height:50px;">
                                 <option value="0">Select District</option>
                                 <?php
                                 $district_rs = Database::search("SELECT * FROM `district`");
                                 $district_num = $district_rs->num_rows;
                                 for ($x = 0; $x < $district_num; $x++) {
                                    $district_data = $district_rs->fetch_assoc();
                                 ?>
                                    <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                          if (!empty($address_data["district_id"])) {
                                                                                             if ($district_data["id"] == $address_data["district_id"]) {
                                                                                          ?>selected<?php
                                                                                                   }
                                                                                                }
                                                                                                      ?>><?php echo $district_data["district_name"]; ?></option>
                                 <?php

                                 }
                                 ?>
                              </select>
                           </div>

                           <div class="form-group">
                              <select class="form-control" id="city" style="height:50px;">
                                 <option value="0">Select City</option>
                                 <?php
                                 $city_rs = Database::search("SELECT * FROM `city`");
                                 $city_num = $city_rs->num_rows;
                                 for ($x = 0; $x < $city_num; $x++) {
                                    $city_data = $city_rs->fetch_assoc();
                                 ?>
                                    <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                    if (!empty($address_data["city_id"])) {
                                                                                       if ($city_data["id"] == $address_data["city_id"]) {
                                                                                    ?>selected<?php                                                             }
                                                                                          } ?>><?php echo $city_data["city_name"]; ?></option>
                                 <?php
                                 }
                                 ?>
                              </select>
                           </div>

                        </div>
                        <div class="block">
                           <div class="checkout-product-details">
                              <div class="payment">
                                 <div class="card-details">
                                    <?php
                                     $json = $_GET["data"];
                                     $obj = json_decode($json);
                                    $Itemobj = new stdClass();
                                    $Itemobj->pid = $obj->pid;
                                    $Itemobj->qty = $obj->qty;
                                    $ijson = json_encode($Itemobj);
                                    ?>
                                    <button class="btn btn-main mt-20" onclick='saveCustermerDetails(<?php echo $ijson; ?>);'>Save & Next</button>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </form>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="product-checkout-details d-none" id="sbox">
                     <div class="block ">
                        <h4 class="widget-title">Order Summary</h4>
                        <div class="media product-card">
                           <div class="media-body">
                              <span>Subtotal:</span>
                              <p class="price">$<?php echo $total ?></p>
                           </div>
                        </div>
                        <div class="discount-code">
                           <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>
                        </div>
                        <ul class="summary-prices">
                           <li>
                              <span>Subtotal:</span>
                              <span class="price">$<?php echo $total ?></span>
                           </li>
                           <li>
                              <span>Shipping:</span>
                              <span id="dfee"><?php $city_data["district_id"]; ?></span>
                           </li>
                        </ul>
                        <div class="summary-total">
                           <span>Total</span>
                           <span>$250</span>
                        </div>
                        <div class="verified-icon">
                           <img src="images/shop/verified.png">
                        </div>
                        <div class="block">
                           <div class="checkout-product-details">
                              <div class="payment">
                                 <div class="card-details">
                                    <a href="confirmation.html" class="btn btn-main mt-20">Place Order</a>
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
   <!-- Modal -->
   <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <form>
                  <div class="form-group">
                     <input class="form-control" type="text" placeholder="Enter Coupon Code">
                  </div>
                  <button type="submit" class="btn btn-main">Apply Coupon</button>
               </form>
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
</body>

</html>