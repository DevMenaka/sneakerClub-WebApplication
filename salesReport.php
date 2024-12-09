<?php $e = $_GET["e"];

require "connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SneeakerClub | Admin Panel | Order</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body id="body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">Sales Report</h1>
                    <ol class="breadcrumb">
                        <li><a href="adminPanel.php">Admin</a></li>
                        <li class="active">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="user-dashboard page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-inline dashboard-menu text-center">
                        <li><a href="adminPanel.php">Dashboard</a></li>
                        <li><a href="<?php echo "order.php?e=" . $e; ?>">Orders</a></li>
                        <li><a class="active" href="<?php echo "salesReport.php?e=" . $adata["id"]; ?>">Sales Report</a></li>
                        <li><a href="<?php echo "addItems.php?e=" . $e ?>">Add Itms</a></li>
                        <li><a href="<?php echo "manageItems.php?e=" . $e; ?>">Manage items</a></li>
                        <li><a href="<?php echo "manageusers.php?e=" . $e; ?>">Manage Users</a></li>
                        <li><a href="<?php echo "adminProfile.php?e=" . $e; ?>">Profile Details</a></li>
                    </ul>

                    <div class="dashboard-wrapper user-dashboard">
                            <div class="col-12 mt-5">
                                <div class="row justify-content-center">
                                    
                                <div class="col-6 col-lg-3  px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 fw-bold">Daily Earnings</span>
                                            <br />
                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";
                                            $tot="0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                if ($invoice_data["status"]==2) {
                                                    $f = $f + $invoice_data["qty"]; //total qty 
                                                }

                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d); //separate date from time
                                                $pdate = $splitDate[0]; //sold date

                                                if ($pdate == $today) {
                                                    if ($invoice_data["status"]==2) {
                                                        $a = $a + $invoice_data["total"];
                                                        $c = $c + $invoice_data["qty"];
                                                    }
                                                    
                                                }

                                                $datetimeString = $invoice_data["date"];

                                                $datetime = new DateTime($datetimeString);


                                                $splitMonth = explode("-", $pdate); //separate date as year,month & date
                                                $pyear = $splitMonth[0]; //year
                                                $pmonth = $splitMonth[1]; //month

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        if ($invoice_data["status"]==2) {
                                                        $b = $b + $invoice_data["total"];
                                                        $e = $e + $invoice_data["qty"];
                                                        }
                                                        
                                                    }
                                                }
                                                  
                                                if ($invoice_data["status"]==2) {
                                                      $tot = $tot+$invoice_data["total"];
                                                    }

                                            }

                                            ?>
                                            <span class="fs-3">$<?php echo $a; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 offset-lg-1 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-black text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 fw-bold">Monthly Earnings</span>
                                            <br />

                                            <span class="fs-3">$<?php echo $b; ?></span>
                                        </div>
                                    </div>
                                </div>   

                                <div class="col-6 col-lg-3  offset-lg-1 px-1 ">
                                    <div class="row g-1">
                                        <div class="col-12 bg-warning text-dark text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 fw-bold">Total Revenue</span>
                                            <br />
                                            <span class="fs-3">$<?php echo $tot; ?></span>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-6 col-lg-3 mt-3  px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-light text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-3"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 offset-lg-1 mt-3  px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-3"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-6 col-lg-3 mt-3 offset-lg-1 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-3"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 mt-3 border-dark px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-warning  text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 text-dark fw-bold">Total Stock Quantity</span>
                                            <br />
                                            <?php
                                            $stock =0;
                                            
                                            $item_rs = Database::search("SELECT * FROM `items`");
                                            $item_num = $item_rs->num_rows;

                                            for($q=0 ; $q < $item_num; $q++){
                                                $itemData = $item_rs->fetch_assoc();
                                                $stock = $stock+$itemData["qty"];
                                            }

                                            ?>
                                            <span class="text-black fs-3"><?php echo $stock; ?> Quantity Available</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 mt-3 offset-lg-1 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-black text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-2 text-light fw-bold">Total value of individual items</span>
                                            <br />
                                            <?php
                                            $value =0;
                                            
                                            $item_rs = Database::search("SELECT * FROM `items`");
                                            $item_num = $item_rs->num_rows;

                                            for($q=0 ; $q < $item_num; $q++){
                                                $itemData = $item_rs->fetch_assoc();
                                                $value = $value+$itemData["price"];
                                            }

                                            ?>
                                            <span class="text-light fs-3">$ <?php echo $value; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 mt-3 offset-lg-1 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success  text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-1 text-light fw-bold">Total Stock Value</span>
                                            <br />
                                            <?php
                                            $value =0;
                                            
                                            $item_rs = Database::search("SELECT * FROM `items`");
                                            $item_num = $item_rs->num_rows;

                                            for($q=0 ; $q < $item_num; $q++){
                                                $itemData = $item_rs->fetch_assoc();
                                                $value = $value+$itemData["price"];
                                            }

                                            ?>
                                            <span class="text-light fs-3">$ <?php echo $value * $stock; ?></span>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
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