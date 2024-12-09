<?php require "connection.php";
$pid = $_GET["id"];
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<title>Add Items</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
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
					<h1 class="page-name">Update Items</h1>
					<ol class="breadcrumb">
						<li><a href="adminPanel.php">Dashboard</a></li>
						<li class="active">Update Items</li>
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
							<select class="form-control" id="brand" disabled>
								<?php

								$item_rs = Database::search("SELECT * FROM `items` WHERE `id`='" . $pid . "'");
								$item_data = $item_rs->fetch_assoc();
								$brand_rs = Database::search("SELECT*FROM `our_brands`WHERE `id`='" . $item_data["our_brands_id"] . "'");
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
							<select class="form-control" id="type" disabled>
								<?php
								$type_rs = Database::search("SELECT*FROM `type` WHERE `id`='" . $item_data["type_id"] . "'");
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
							<select class="form-control" id="size" disabled>
								<?php

								$size_rs = Database::search("SELECT*FROM `sizes` WHERE `id`='" . $item_data["sizes_id"] . "'");
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
							<select class="form-control" id="colour" disabled>
								<?php

								$colour_rs = Database::search("SELECT*FROM`colour` WHERE `id`='" . $item_data["colour_id"] . "'");
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
					<div class="col-md-12">
						<div class="widget">
							<h4 class="widget-title">Item Title</h4>
							<input type="text" class="form-control" placeholder="Title..." value="<?php echo $item_data["title"]; ?>" id="title" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="widget">
							<h4 class="widget-title">Item Description</h4>
							<textarea type="text" class="form-control" placeholder="Description..." id="description"><?php echo $item_data["description"]; ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row justify-content-center">
					<div class="col-md-6 mt-2">
						<div class="widget">
							<h4 class="widget-title">Item Quantity</h4>
							<input type="number" class="form-control" value="<?php echo $item_data["qty"]; ?>" min="0" id="qty" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="widget">
							<h4 class="widget-title">Item Price</h4>
							<input type="text" class="form-control" value="Rs.<?php echo $item_data["price"]; ?>.00" placeholder="Item Price..." id="price" disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="widget">
							<h4 class="widget-title">delevery fee colombo</h4>
							<input type="text" value="<?php echo $item_data["delevery_fee_colombo"]; ?>" class="form-control" placeholder="delevery fee colombo..." id="dfc" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="widget">
							<h4 class="widget-title">delevery fee other</h4>
							<input type="text" value="<?php echo $item_data["delever_fee_other"]; ?>" class="form-control" placeholder="delevery fee other..." id="dfo" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php

		$img = array();
		$img[0] = "images/shop/items/download.png";
		$img[1] =  "images/shop/items/download.png";
		$img[2] = "images/shop/items/download.png";
		$img[3] = "images/shop/items/download.png";
		$img[4] = "images/shop/items/download.png";
		$img[5] = "images/shop/items/download.png";

		$images_rs = Database::search("SELECT * FROM `images` WHERE `items_id`='" .$item_data["id"]. "'");
		$images_num = $images_rs->num_rows;

		for ($x = 0; $x < $images_num; $x++) {
			$images_data = $images_rs->fetch_assoc();
			$img[$x] = $images_data["path"];
		}
		?>

		<div class="col-md-12">
			<div class="row g-2">

				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="<?php echo $img[0];?>" alt="product-img" style="height:200px;" id="img0" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="<?php echo $img[1];?>" alt="product-img" style="height:200px;" id="img1" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="<?php echo $img[2];?>" alt="product-img" style="height:200px;" id="img2" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="<?php echo $img[3];?>" alt="product-img" style="height:200px;" id="img3" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="<?php echo $img[4];?>" alt="product-img" style="height:200px;" id="img4" />
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div>
						<div class="product-thumb">
							<img class="img-responsive" src="<?php echo $img[5];?>" alt="product-img" style="height:200px;" id="img5" />
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
				<button class="btn btn-success mt-20" onclick='updateItems(<?php echo $item_data["id"];?>)'>Submit</button>
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