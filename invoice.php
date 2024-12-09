<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | SneakerClub</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body class="mt-2 bgimge">
    <div class="col-12">
        <?php
        require "header.php";
        if (isset($_SESSION["u"])){
            $oid = $_GET["id"];

            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
            $invoice_data = $invoice_rs->fetch_assoc();

        ?>
    </div>
    <div class="offset-1 col-10">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 btn-toolbar justify-content-end">
                    <div class=" text-end">
                        <button class="btn btn-success me-2" onclick="printInvoice();">Print Invoice <i class="bi bi-printer-fill"></i></button>
                    </div>
                </div>
                <div class="col-12">
                    <hr class=" border border-1 border-dark" />
                </div>

                <div class="col-12" id="page">
                    <div class="row">

                        <div class="col-3 text-center">
                            <h1 class="bg-dark text-white">SneakerClub</h1>
                        </div>

                        <div class="col-12">
                            <div class="row mt-3">
                                <div class="col-12 text-primary">
                                    <h3 class="text-primary">INVOICE <?php echo $invoice_data["id"];?></h3>
                                </div>
                                <div class="col-12 fw-bold ">
                                    <span>ID: <span class="text-decoration-underline"><?php echo $oid?></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class=" border border-2 border-dark" />
                        </div>
                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-info">Date&Time:<span class="fs-4 text-black"><?php echo $invoice_data["date"];?></span></h4>
                                    <h4 class="text-info"><span class="fs-6 text-black">Currency:USD($)</span></h4>
                                </div>
                                <div class="col-6 text-end mt-4">
                                    <div class="col-12">
                                        <div class="offset-7 text-start col-5">
                                            <h4 class="text-primary text-decoration-underline">Customer</h4>
                                            <span class="fw-bold">Name :</span><span><?php echo $data["fname"] . " " . $data["lname"];?></span><br />
                                            <span class="fw-bold">Email :</span><span><?php echo $data["email"]?></span><br />
                                            <?php
                                            $mAddress_rs = Database::search("SELECT*FROM`member_has_adress` WHERE `member_mail`='".$data["email"]."'");
                                            $mAddressData = $mAddress_rs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold">Postal Code :</span><span><?php echo $mAddressData["zip"];?></span><br />
                                            <span class="fw-bold">Address-1 :</span><span><?php echo $mAddressData["line1"];?></span><br />
                                            <span class="fw-bold">Address-2 :</span><span><?php echo $mAddressData["line2"];?></span><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">

                                <thead>
                                    <tr class="border border-3 border-secondary">
                                        <th>#</th>
                                        <th>Oder ID & Product</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 72px;">
                                        <td class="bg-dark text-white fs-3"><?php echo $invoice_data["id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-decoration-underline p-2 text-primary"><?php echo $oid ?></span><br />
                                            <?php
                                            $product_rs = Database::search("SELECT*FROM `items` WHERE `id`='" . $invoice_data["item_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold text-primary fs-4 p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">$<?php echo $product_data["price"]; ?></td>
                                        <td class="fw-bold fs-6 text-end pt-4"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">$<?php echo $invoice_data["total"]; ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                    <?php

                                    $city_rs = Database::search("SELECT*FROM `city` WHERE `id`='" . $mAddressData["city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;

                                    if ($city_data["district_id"] == 1) {
                                        $delivery = $product_data["delevery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delever_fee_other"];
                                    }

                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery

                                    ?>

                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold"> SUBTOTAL</td>
                                        <td class="text-end">$<?php echo $g; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary">Delivery Fee</td>
                                        <td class="text-end border-primary">$<?php echo $delivery; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">GRAND TOTAL</td>
                                        <td class="text-end border-primary text-primary">$<?php echo $t; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12 border-start border-5 border-primary mt-3 mb-3 round bg-light">
                            <div class="row">
                                <div class="col-11 offset-1  mt-3 mb-3">
                                    <label class="form-label fw-bold fs-5">NOTICE :</label><br />
                                    <label class="form-label fw-bold fs-5">Purchased items can retern before 5 days of Dilivery.</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class=" border border-1 border-primary" />
                        </div>
                        <div class="col-12 text-center mb-3">
                            <label class="form-label mb-3">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
                </div>
            <?php
        }
            ?>
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
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>