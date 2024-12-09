<!DOCTYPE html>
<html>

<head>
	<title>Sneaker Club | Wide Varieties Sneaker Marketplace</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
	<link rel="stylesheet" href="plugins/themefisher-font/style.css">
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="plugins/animate/animate.css">
	<link rel="stylesheet" href="plugins/slick/slick.css">
	<link rel="stylesheet" href="plugins/slick/slick-theme.css">
	<link rel="stylesheet" href="css/style.css">

</head>

<body id="body">
	<div class="container-fluid">
		<?php include "header.php";
		?>
		<div id="bscearch_results">
			<div class="row justify-content-center align-content-center">
				<div class="hero-slider">
					<div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-1.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-lg-8 text-center">
									<p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
									<h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The Beauty of Youth <br> is hidden in details.</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-3.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-lg-8 text-center">
									<p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
									<h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">Asian Biggest <br> Sneakers Market place.</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-2.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-lg-8 text-center">
									<p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
									<h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">Fashionable <br> Items.</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-4.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-lg-8 text-center">
									<p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
									<h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-5.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-lg-8 text-center">
									<p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
									<h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-6.jpg);">
						<div class="container">
							<div class="row">
								<div class="col-lg-8 text-center">
									<p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
									<h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
								</div>
							</div>
						</div>
					</div>
				</div>

				

				<section class="products section bg-gray">
					<div class="container">
						<div class="row">
							<div class="title text-center">
								<h2>ITEMS</h2>
							</div>
						</div>

						<?php

						$ob_rs = Database::search("SELECT * FROM `our_brands`");
						$ob_num = $ob_rs->num_rows;

						for ($y = 0; $y < $ob_num; $y++) {
							$bdata = $ob_rs->fetch_assoc();
						?>
							<div>
								<div class="col-12 mt-4 mb-3 border-1 border-bottom">
									<a href="#" class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $bdata["name"]; ?></a>&nbsp;&nbsp;
									<a href="" class="text-decoration-none link-dark fs-6">More items &nbsp;&rarr;</a>
								</div>

								

								<div class="row">
									<?php
									$item_rs = Database::search("SELECT * FROM `items` WHERE `our_brands_id`='" . $bdata["id"] . "' AND 
                                    `status`='1' ORDER BY `date_time_added` DESC LIMIT 4 OFFSET 0 ");
									$item_num = $item_rs->num_rows;

									for ($z = 0; $z < $item_num; $z++) {
										$item_data = $item_rs->fetch_assoc();

										if ($item_data["status"] == 1 && $item_data["qty"] > 0) {


									?>

											<div class="col-md-3">
												<div class="product-item">
													<div class="product-thumb">
														<?php
														$rimgrs = Database::search("SELECT * FROM `images` WHERE `items_id`='" . $item_data["id"] . "' ");
														$rimg_data = $rimgrs->fetch_assoc();
														?>
                
														<img class="img-responsive" src="<?php echo $rimg_data["path"]; ?>" alt="product-img" style="height:400px;" />
														<div class="preview-meta">
															<ul>
																<li>
																	<span data-toggle="modal" onclick='pdModel(<?php echo $item_data["id"]; ?>);' data-target="#product-modal">
																		<i class="tf-ion-ios-search"></i>
																	</span>
																</li>
																<li>
																	<a onclick='addToWatchlist(<?php echo $item_data["id"]; ?>);'><i class="tf-ion-ios-heart"></i></a>
																</li>
																<li>
																	<a onclick='addToCart(<?php echo $item_data["id"]; ?>);'><i class="tf-ion-android-cart"></i></a>
																</li>
															</ul>
														</div>
													</div>
													<div class="product-content">
														<h4><a href="<?php echo "singleProductView.php?id=" . $item_data["id"]; ?>"><?php echo $item_data["title"]; ?></a></h4>
														<p class="price">$<?php echo $item_data["price"]; ?></p>
													</div>
												</div>
											</div>


									<?php
										}
									}

									?>

								<?php

							}
								?>
								<!--  -->
								<div class="modal" tabindex="-1" id="productModel">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body">
												<div class="row">
													<div class="col-12" id="mbody">
													</div>
													<div class="col-12">
														<div class="row justify-content-center">
															<div class="col-12 text-center p-5">
																<button class="btn btn-close text-end" data-bs-dismiss="modal">Close</button>
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
							<!--  -->

					</div>
			</div>
			</section>


			<!--Start Call To Action==================================== -->
			<section class="call-to-action bg-gray section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="title">
								<h2>SUBSCRIBE TO NEWMEMBERS</h2>
							</div>
							<div class="col-lg-6 col-md-offset-3">
								<div class="input-group subscription-form">
									<input type="text" class="form-control" placeholder="Enter Your Email Address">
									<span class="input-group-btn">
										<button class="btn btn-main" type="button">Subscribe Now!</button>
									</span>
								</div><!-- /input-group -->
							</div><!-- /.col-lg-6 -->

						</div>
					</div> <!-- End row -->
				</div> <!-- End container -->
			</section> <!-- End section -->

		</div>
	</div>
	</div>

	<footer class="footer section text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="social-media">
						<li>
							<a href="https://www.facebook.com/">
								<i class="tf-ion-social-facebook"></i>
							</a>
						</li>
						<li>
							<a href="https://www.instagram.com/">
								<i class="tf-ion-social-instagram"></i>
							</a>
						</li>
						<li>
							<a href="https://www.twitter.com/">
								<i class="tf-ion-social-twitter"></i>
							</a>
						</li>
						<li>
							<a href="https://www.pinterest.com/">
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
					<p class="copyright-text">Copyright &copy;2021, Full Ownership &amp; Marketing by SneakerClub</p>
				</div>
			</div>
		</div>
	</footer>



	<script src="plugins/jquery/dist/jquery.min.js"></script>
	<script src="plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
	<script src="plugins/instafeed/instafeed.min.js"></script>
	<script src="plugins/syo-timer/build/jquery.syotimer.min.js"></script>
	<script src="plugins/slick/slick.min.js"></script>
	<script src="plugins/slick/slick-animation.min.js"></script>
	<script src="js/script.js"></script>
	<script src="script.js"></script>
	<script src="bootstrap.bundle.js"></script>
</body>

</html>