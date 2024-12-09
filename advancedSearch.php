<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>Advanced Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
    <link rel="stylesheet" href="css/bootstrap.css" />

</head>

<body id="body">

    <?php include "header.php"; ?>

    <div class="container page-header">
        <div class="row">
            <div class="col-md-11">
                <div class="content text-center">
                    <h1 class="page-name">Advanced Search</h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php">Home</a></li>
                        <li class="active">advanced Search</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container products section">
        <div class="row">

            <div class="col-12">
                <div class="row justify-content-center">

                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="widget">
                                    <input type="text" class="form-control" placeholder="Enter Title..." id="title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <h4 class="widget-title">Brand</h4>
                            <select class="form-control" id="brand">
                                <option value="0">Select Brand</option>
                                <?php

                                $brand_rs = Database::search("SELECT*FROM `our_brands`");
                                $brand_num = $brand_rs->num_rows;

                                for ($x = 0; $x < $brand_num; $x++) {
                                    $brand_data = $brand_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                <?php

                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <h4 class="widget-title">Type</h4>
                            <select class="form-control" id="type">
                                <option value="0">Select Type</option>
                                <?php
                                $type_rs = Database::search("SELECT*FROM `type`");
                                $type_num = $type_rs->num_rows;

                                for ($x = 0; $x < $type_num; $x++) {
                                    $type_data = $type_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $type_data["id"]; ?>"><?php echo $type_data["name"]; ?></option>
                                <?php

                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <h4 class="widget-title">Size</h4>
                            <select class="form-control" id="size">
                                <option value="0">Select Size</option>
                                <?php

                                $size_rs = Database::search("SELECT*FROM `sizes`");
                                $size_num = $size_rs->num_rows;

                                for ($s = 0; $s < $size_num; $s++) {
                                    $size_data = $size_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $size_data["id"]; ?>"><?php echo $size_data["size"] ?></option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <h4 class="widget-title">Colour</h4>
                            <select class="form-control" id="colour">
                                <option value="0">Select Colour</option>
                                <?php

                                $colour_rs = Database::search("SELECT*FROM`colour`");
                                $colour_num = $colour_rs->num_rows;

                                for ($c = 0; $c < $colour_num; $c++) {
                                    $colour_data = $colour_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $colour_data["id"]; ?>"><?php echo $colour_data["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="widget">
                            <input type="text" class="form-control" placeholder="Price From..." id="priceF">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget">
                            <input type="text" class="form-control" placeholder="Price To..." id="priceT">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="widget">
                    <select class="form-control" id="sortId">
                        <option value="0">Sort By</option>
                        <option value="1">PRICE HIGH TO LOW</option>
                        <option value="2">PRICE LOW TO HIGH</option>
                        <option value="3">QTY HIGH TO LOW</option>
                        <option value="4">QTY LOW TO HIGH</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-grid">
            <div class="input-group mb-3 d-grid">
                <button class="btn btn-main pull-right fw-bolder fs-4" onclick="advancedSearch();">Search</button>
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