<?php require "connection.php"; ?>
<!DOCTYPE html>
<html>

<!-- ok -->

	<meta charset="utf-8">
	<title>Add Items</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
	<link rel="stylesheet" href="plugins/themefisher-font/style.css">
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body id="body">

	<div class="container">
		<div class="row">
			<div class="col-md-11">
				<div class="content text-center">
					<h1 class="page-name">Add Items</h1>
					<ol class="breadcrumb">
						<li><a href="adminPanel.php">Dashboard</a></li>
						<li class="active">Add Items</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="container products section">
		<div class="row">

			<div class="col-12">
				<div class="row justify-content-center">
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
							<?php
							$size_rs = Database::search("SELECT*FROM`sizes`");
							for ($sz = 0; $sz < $size_rs->num_rows; $sz++) {
								$sizeData=$size_rs->fetch_assoc();
							?>
                                
								<div class="col-md-1">
										<label class="form-check-label"><?php echo $sizeData["size"]; ?></label>
										<input class="form-check mt-0" id="in1" type="checkbox" value="12"/>
								</div>
							<?php
							}
							?>

						</div>
					</div>
					<div class="col-md-3">
						<div class="widget">
							<h4 class="widget-title">Colour</h4>
								<?php
							$colour_rs = Database::search("SELECT*FROM`colour`");
							for ($colour = 0; $colour < $colour_rs->num_rows; $colour++) {
							?>
								<div class="col-md-3">
										<label class="form-check-label"><?php echo $colour_rs->fetch_assoc()["name"]; ?></label>
										<input class="form-check mt-0" type="checkbox" name="" id="">
								</div>
							<?php
							}
							?>
						</div>
					</div>

				</div>
			</div>
			<div class="col-12">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="widget">
							<h4 class="widget-title">Item Title</h4>
							<input type="text" class="form-control" placeholder="Title..." id="title">
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="widget">
							<h4 class="widget-title">Item Description</h4>
							<textarea type="text" class="form-control" placeholder="Description..." id="description"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row justify-content-center">
					<div class="col-md-6 mt-2">
						<div class="widget">
							<h4 class="widget-title">Item Quantity</h4>
							<input type="number" class="form-control" value="0" min="0" id="qty" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="widget">
							<h4 class="widget-title">Item Price</h4>
							<input type="text" class="form-control" placeholder="Item Price..." id="price">
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="widget">
							<h4 class="widget-title">delevery fee colombo</h4>
							<input type="text" class="form-control" placeholder="delevery fee colombo..." id="dfc" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="widget">
							<h4 class="widget-title">delevery fee other</h4>
							<input type="text" class="form-control" placeholder="delevery fee other..." id="dfo" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row g-2">

				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="images/shop/items/download.png" alt="product-img" style="height:200px;" id="img0" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="images/shop/items/download.png" alt="product-img" style="height:200px;" id="img1" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="images/shop/items/download.png" alt="product-img" style="height:200px;" id="img2" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="images/shop/items/download.png" alt="product-img" style="height:200px;" id="img3" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="images/shop/items/download.png" alt="product-img" style="height:200px;" id="img4" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="images/shop/items/download.png" alt="product-img" style="height:200px;" id="img5" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
			<input type="file" class="d-none" id="itemImage" multiple />
			<label for="itemImage" class="col-12 btn btn-dark" onclick="uploadItemImage();">Upload Item Images</label>
		</div>
		<div class="col-md-12 d-grid mt-5">
			<div class="input-group mb-3 d-grid">
				<button class="btn btn-success mt-20" onclick="addItem();">Submit</button>
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

	<!-- 
    Essential Scripts
    =====================================-->

	<script src="plugins/jquery/dist/jquery.min.js"></script>
	<script src="plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
	<script src="js/script.js"></script>
	<script src="script.js"></script>
</body>

</html>