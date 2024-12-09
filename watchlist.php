<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>SneakerClub | Watchlist</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body id="body">
    <?php include "header.php"; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Watchlist</h1>
                        <ol class="breadcrumb">
                            <li><a href="home.php">Home</a></li>
                            <li class="active">Watchlist</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $wrs = Database::search("SELECT * FROM `watchlist` WHERE `m_email`='" . $data["email"] . "'");
    $wnum = $wrs->num_rows;
    if ($wnum == 0) {

    ?>

        <section class="empty-cart page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="block text-center">
                            <i class="tf-ion-ios-heart"></i>
                            <h2 class="text-center">Your Watchlist is currently empty.</h2>
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
                                                    <th class="">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                    <?php for ($z = 0; $z < $wnum; $z++) {
                                        $wdata = $wrs->fetch_assoc();
                                        $wirs = Database::search("SELECT * FROM `items` INNER JOIN `images` ON
                                        items.id=images.items_id WHERE id ='" . $wdata["item_id"] . "'");

                                        $widata = $wirs->fetch_assoc();
                                     ?>

                                                <tr class="">
                                                    <td class="">
                                                        <div class="product-info">
                                                            <img width="80" src="<?php echo $widata["path"]; ?>" alt="" />
                                                            <a href="#!"><?php echo $widata["title"]; ?></a>
                                                        </div>
                                                    </td>
                                                    <td class="">$<?php echo $widata["price"];?></td>
                                                    <td class="">
                                                        <a onclick='removeWachlist(<?php echo $wdata["id"];?>);' class="product-remove" href="#!">Remove</a>
                                                    </td>
                                                </tr>
                                                <?php   
                                    }
                                    ?>
                                            </tbody>
                                        </table>
                                        <a href="checkout.html" class="btn btn-main pull-right">Checkout</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        
    } ?>
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