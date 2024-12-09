<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $data = $_SESSION["u"];
    $total = 0;
    $crs = Database::search("SELECT * FROM `cart` WHERE `user_mail`='" . $data["email"] . "'");
    $cnum = $crs->num_rows;
    $ary = array();

}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sneaker Club | Wide Varieties Sneaker Marketplace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
    <link rel="stylesheet" href="plugins/themefisher-font/style.css">
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Start Top Header Bar -->
    <section class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <div class="contact-number">
                        <i class="tf-ion-ios-telephone"></i>
                        <span>0129- 12323-123123</span>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <!-- Site Logo -->
                    <div class="logo text-center">
                        <h1 class="fw-bold hedText">Sneaker Club</h1>
                    </div>
                </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <!-- Cart -->
                        <ul class="top-menu text-right list-inline">
                            <?php
                            if (isset($_SESSION["u"])) {
                            ?>
                                <li class="dropdown cart-nav dropdown-slide">
                                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-android-cart"></i>Cart(<?php echo $cnum; ?>)</a>
                                    <div class="dropdown-menu cart-dropdown">
                                        <?php
                                        if ($cnum == 0) {
                                        ?>
                                            <!-- Cart Item -->
                                            <div class="media">
                                                <a class="pull-left" href="#!">
                                                    <i class="tf-ion-ios-cart-outline"></i>
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="<?php echo "cart.php?e=" . $data["email"]; ?>">Empty Cart</a></h4>
                                                </div>
                                            </div>
                                            <!-- / Cart Item -->
                                            <?php
                                        } else {
                                            for ($x = 0; $x < $cnum; $x++) {
                                                $cdata = $crs->fetch_assoc();
                                                $irs = Database::search("SELECT * FROM `items` INNER JOIN `images` ON
                                        items.id=images.items_id WHERE id ='" . $cdata["item_id"] . "'");
                                                 
                                                $idata = $irs->fetch_assoc();
                                                $stotal = ($idata["price"] * $cdata["cart_qty"]);
                                                $total = $total + ($idata["price"] * $cdata["cart_qty"]);
                                    
                                            ?>
                                                <div class="media">
                                                    <a class="pull-left" href="#!">
                                                        <img class="media-object" style="height: 60px;" src="<?php echo $idata["path"]; ?>" alt="image" />
                                                    </a>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><a href="#!"><?php echo $idata["title"]; ?></a></h4>
                                                        <div class="cart-price">
                                                            <span><?php echo $cdata["cart_qty"]; ?> x</span>
                                                            <span>$<?php echo $idata["price"]; ?></span>
                                                        </div>
                                                        <a onclick="deletFromCart(<?php echo $cdata['id']; ?>)" href="#!" class="remove"><i class="tf-ion-close"></i></a>
                                                        <h5><strong>$<?php echo $stotal; ?></strong></h5>
                                                    </div>
                                                <?php
                                            }     
                                                ?>

                                                <div class="cart-summary">
                                                    <span>Total</span>
                                                    <span class="total-price">$<?php echo $total ?></span>
                                                </div>
                                                <ul class="text-center cart-buttons">
                                                    <li><a href="<?php echo "cart.php?e=" . $data["email"]; ?>" class="btn btn-small">View Cart</a></li>
                                                    <?php if(isset($_SESSION["u"])) {
                                                        ?>
                                                        <li><a href="" class="btn btn-small btn-solid-border">Checkout</a></li>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <li><a href=""class="btn disabled btn-small btn-solid-border">Checkout</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                </ul>
                                                </div>
                                            <?php
                                        }
                                            ?>

                                </li><!-- / Cart -->
                            <?php
                            }
                            ?>

                            <!-- Search -->
                            <li class="dropdown search dropdown-slide">
                                <p class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-ios-search-strong"></i> Search</p>
                                <ul class="dropdown-menu search-dropdown">
                                    <li><input type="search" id="basic_search_text" class="form-control" onkeypress="basicSearch();" placeholder="Search...">
                                    </li>
                                    <li class="mt-5">
                                    <!-- <li><a href="advancedSearch.php" class="btn btn-small btn-solid-border">Advanced</a></li> -->
                                </ul>
                            </li><!-- / Search -->

                            <!-- Languages -->
                            <li class="commonSelect">
                                <select class="form-control">
                                    <option>EN</option>
                                </select>
                            </li><!-- / Languages -->

                        </ul><!-- / .nav .navbar-nav .navbar-right -->
                    </div>

            </div>
        </div>
    </section><!-- End Top Header Bar -->


    <!-- Main Menu Section -->
    <section class="menu">
        <nav class="navbar navigation">
            <div class="container">

                <!-- Navbar Links -->
                <div id="navbar" class="navbar-collapse collapse text-center">
                    <ul class="nav navbar-nav">

                        <!-- Home -->
                        <li class="dropdown ">
                            <a href="home.php">Home</a>
                        </li><!-- / Home -->


                        <!-- Elements -->
                        <li class="dropdown dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Shop <span class="tf-ion-ios-arrow-down"></span></a>
                            <div class="dropdown-menu">
                                <div class="row">

                                    <!-- Basic -->
                                    <div class="col-lg-12 col-md-12 mb-sm-6">
                                        <ul>
                                            <li class="dropdown-header">Pages</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="<?php echo "cart.php?e=" . $data["email"]; ?>">Cart</a></li>
                                            <li><a href="<?php echo "watchlist.php?e=" . $data["email"]; ?>">Watch List</a></li>
                                            

                                        </ul>
                                    </div>


                                </div><!-- / .row -->
                            </div><!-- / .dropdown-menu -->
                        </li><!-- / Elements -->


                        <!-- Pages -->
                        <li class="dropdown  dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="tf-ion-ios-arrow-down"></span></a>
                            <div class="dropdown-menu">
                                <div class="row">

                                   
                                    <div class="col-sm-6 col-6">
                                        <ul>
                                            <li class="dropdown-header">Utility</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="index.php">Login Page</a></li>
                                            <li><a href="index.php" onclick="signout();">Log Out</a></li>
                                        </ul>
                                        
                                    </div>

                                    <!-- Mega Menu -->
                                    <div class="col-sm-6 col-6 justify-content-end overflow-hidden">
                                        <a href="home.php">
                                            <img class="" src="images/img-bg.jpg" alt="menu image" style="height:100px;"/>
                                        </a>
                                    </div>
                                </div><!-- / .row -->
                            </div><!-- / .dropdown-menu -->
                        </li><!-- / Pages -->

                        <!-- Shop -->
                    </ul><!-- / .nav .navbar-nav -->

                </div>
                <!--/.navbar-collapse -->
            </div><!-- / .container -->
        </nav>
    </section>
<script src="script.js"></script>
</body>