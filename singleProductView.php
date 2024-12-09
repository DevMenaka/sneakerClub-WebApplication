<?php include "header.php";

if (isset($_GET["id"])) {
	$pid = $_GET["id"];
	$itemrs = Database::search("SELECT items.price,items.qty,items.title,
    items.description,items.date_time_added,items.delevery_fee_colombo,items.delever_fee_other,
    items.status,items.colour_id,items.our_brands_id,items.type_id,
    items.sizes_id FROM `items`WHERE items.id='" . $pid . "'");

	$itemnum = $itemrs->num_rows;

	if ($itemnum == 1) {

		$itemdata = $itemrs->fetch_assoc();

?>

		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="utf-8">
			<title>SneakerClub | Single Single ProductView</title>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
			<link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
			<link rel="stylesheet" href="plugins/themefisher-font/style.css">
			<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
			<script src="https://js.stripe.com/v3/"></script>
			<link rel="stylesheet" href="css/style.css">

		</head>

		<body id="body">
			<section class="single-product">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<ol class="breadcrumb">
								<li><a href="home.php">Home</a></li>
								<li class="active">Single Product</li>
							</ol>
						</div>
					</div>
					<div class="row mt-20">
						<div class="col-md-5">
							<div class="single-product-slider">
								<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
									<div class='carousel-outer'>
										<!-- me art lab slider -->
										<div class='carousel-inner '>

											<?php
											$img_rs = Database::search("SELECT * FROM `images` WHERE `items_id`='" . $pid . "'");
											$img_num = $img_rs->num_rows;
											$img = array();
											$imgdata = $img_rs->fetch_assoc();
											?>

											<div class='item active'>
												<img src='<?php echo $imgdata["path"]; ?>' alt='' data-zoom-image="images/shop/single-products/product-1.jpg" style="height:700px;" />
											</div>

											<?php

											if ($img_num != 0) {

												for ($x = 1; $x < $img_num; $x++) {
													$img_data = $img_rs->fetch_assoc();
													$img[$x] = $img_data["path"];

											?>

													<div class='item'>
														<img src='<?php echo $img_data["path"]; ?>' alt='' data-zoom-image="images/shop/single-products/product-1.jpg" style="height:700px;" />
													</div>

											<?php
												}
											}
											?>

										</div>

										<!-- sag sol -->
										<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
											<i class="tf-ion-ios-arrow-left"></i>
										</a>
										<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
											<i class="tf-ion-ios-arrow-right"></i>
										</a>
									</div>

									<!-- thumb -->

									<?php
									$irs = Database::search("SELECT * FROM `images` WHERE `items_id`='" . $pid . "'");
									$inum = $irs->num_rows;
									$img = array();
									$idata = $img_rs->fetch_assoc();
									?>

									<ol class='carousel-indicators mCustomScrollbar'>
										<li data-target='#carousel-custom' class='active'>
											<img src='<?php echo $idata["path"]; ?>' alt='' />
										</li>

										<?php

										if ($img_num != 0) {

											for ($i = 0; $i < $img_num; $i++) {
												$itemimgdata = $irs->fetch_assoc();
												$img[$x] = $img_data["path"];

										?>

												<li data-target='#carousel-custom' data-slide-to='<?php echo $i ?>'>
													<img src='<?php echo $itemimgdata["path"]; ?>' style="height:100px;" />
												</li>

										<?php
											}
										}
										?>



									</ol>

								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="single-product-details">
								<h2><?php echo $itemdata["title"]; ?></h2>
								<p class="product-price">$<?php echo $itemdata["price"]; ?></p>

								<p class="product-description mt-20"><?php echo $itemdata["description"]; ?></p>
								<div class="color-swatches">
									<span>color:</span>
									<?php $colour_rs = Database::search("SELECT * FROM `colour`
									WHERE `id`= '" . $itemdata["colour_id"] . "'");
									$colourdata = $colour_rs->fetch_assoc();
									?>
									<span><?php echo $colourdata["name"]; ?></span>
								</div>
								<?php $size_rs = Database::search("SELECT * FROM `sizes`
									WHERE `id`= '" . $itemdata["sizes_id"] . "'");
								$sizedata = $size_rs->fetch_assoc();
								?>
								<div class="product-size">
									<span>Size:</span>
									<span><?php echo $sizedata["size"]; ?></span>
								</div>

								<div class="border border-1 border-secondary rounded-0 overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
									<div class="col-12">
										<span class="fw-bold">Quantity : </span>
										<input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue(<?php echo $itemdata["qty"]; ?>);' />

										<div class="position-absolute qty-buttons">
											<div class="justify-content-center rounded-0 d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-inc">
												<i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $itemdata["qty"]; ?>)'></i>
											</div>
											<div class="justify-content-center rounded-0 d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
												<i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec(<?php echo $itemdata["qty"]; ?>)'></i>
											</div>
										</div>
									</div>
								</div>

								<?php

								if ($itemdata["qty"] < 5) {
								?>
									<span class="text-danger">Limited Quantity<i class="bi bi-exclamation-lg"></i></span>

								<?php
								}

								?>
								<div class="product-category">
									<span>Brand:</span>
									<?php
									$brand_rs = Database::search("SELECT * FROM `our_brands` WHERE `id`='" . $itemdata["our_brands_id"] . "'");
									$brandData = $brand_rs->fetch_assoc();
									?>
									<ul>
										<li><?php echo $brandData["name"]; ?></li>
									</ul>

								</div>
								<div class="product-category">
									<span>Type:</span>
									<?php
									$type_rs = Database::search("SELECT * FROM `type` WHERE `id`='" . $itemdata["type_id"] . "'");
									$typeData = $type_rs->fetch_assoc();
									?>
									<ul>
										<li><?php echo $typeData["name"]; ?></li>
									</ul>

								</div>
								<div class="col-6 text-center mt-5">
									<span class="text-danger" id="txt"></span>
								</div>
								<div class="col-6 mt-5">
									<a href="cart.html" class="btn btn-main bg-warning" onclick='addToCart(<?php echo $pid; ?>);'>Add To Cart</a>
									<?php
									if (isset($_SESSION["u"])) {
										?>
										<a onclick="coustermerForm(<?php echo $pid ?>);" class="btn btn-main bg-success pull-right">Checkout</a>
										<?php
									}else{
										?>
										<a onclick="coustermerForm(0);" class="btn btn-main bg-success pull-right">Checkout</a>
										<?php
									}
									?>
									
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="tabCommon mt-20">
								<ul class="nav nav-tabs">
									<?php
									$review_rs = Database::search("SELECT * FROM `reviews` WHERE `item_id`='" . $pid . "'");
									$rnum = $review_rs->num_rows;
									?>
									<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
									<li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews (<?php echo $rnum ?>)</a></li>
								</ul>
								<div class="tab-content patternbg">
									<div id="details" class="tab-pane fade active in">
										<h4>Product Description</h4>
										<p><?php echo $itemdata["description"]; ?></p>
									</div>
									<div id="reviews" class="tab-pane fade">
										<div class="post-comments">
											<ul class="media-list comments-list m-bot-50 clearlist">
												<!-- Comment Item start-->
												<?php

												for ($r = 0; $r < $rnum; $r++) {
													$rdata = $review_rs->fetch_assoc();
												?>
													<li class="media">

														<a class="pull-left" href="#!">
															<img class="media-object comment-avatar" src="images/profile-icon-9.png" alt="" width="50" height="50" />
														</a>

														<?php $mrs = Database::search("SELECT * FROM `members`
														WHERE `email`='" . $rdata["member_email"] . "'");
														$mdata = $mrs->fetch_assoc();
														?>

														<div class="media-body">
															<div class="comment-info">
																<h4 class="comment-author">
																	<a href="#!"><?php echo $mdata["fname"] . " " . $mdata["lname"] ?></a>

																</h4>
																<time datetime="2013-04-06T13:53"><?php echo $rdata["date_time"]; ?></time>
																<!-- <a class="comment-button" href="#!"><i class="tf-ion-chatbubbles"></i>Reply</a> -->
															</div>

															<p>
																<?php echo $rdata["Comment"]; ?>
															</p>
														</div>

													</li>
												<?php
												}
												?>
												<!-- End Comment Item -->

												<!-- Comment Item start-->
												<?php if (isset($_SESSION["u"])) {
												?>
													<li class="media">
														<label>Comment</label>
														<?php
														$Itemobj = new stdClass();
														$Itemobj->pid = $pid;
														$Itemobj->email = $data["email"];
														$Itemobj->status = $data["status"];
														$reveiw = json_encode($Itemobj);

														if (isset($_SESSION["u"])) {
														?>
															<div class="media-body btn-group">
																<textarea class="form-control" maxlength="250" onkeyup="textLenght();" id="review"></textarea>

																<button class="btn btn-success rounded-0" onclick='review(<?php echo $reveiw; ?>);'>Submit</button>
															</div>
														<?php
														}
														?>

													</li>
												<?php
												} ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="products related-products section">
				<div class="container">
					<div class="row">
						<div class="title text-center">
							<h2>Related Items</h2>
						</div>
					</div>
					<div class="row">

						<?php
						$related_rs = Database::search("SELECT * FROM `items` WHERE `our_brands_id`='" . $itemdata["our_brands_id"] . "' AND
						`id`!='" . $pid . "' ORDER BY `date_time_added` DESC LIMIT 4 OFFSET 0");
						$related_num = $related_rs->num_rows;

						if (0 < $related_num) {

							for ($z = 0; $z < $related_num; $z++) {
								$relatedData = $related_rs->fetch_assoc();
						?>
								<div class="col-md-3">
									<div class="product-item">
										<div class="product-thumb">
											<?php
											$rimgrs = Database::search("SELECT * FROM `images` WHERE `items_id`='" . $relatedData["id"] . "' ");
											$rimg_data = $rimgrs->fetch_assoc();
											?>
											<img class="img-responsive" src="<?php echo $rimg_data["path"]; ?>" alt="product-img" style="height:400px;" />
											<div class="preview-meta">
												<ul>
													<li>
														<span data-toggle="modal" onclick='pdModel(<?php echo $relatedData["id"]; ?>);' data-target="#product-modal">
															<i class="tf-ion-ios-search"></i>
														</span>
													</li>
													<li>
														<a onclick='addToWatchlist(<?php echo $relatedData["id"]; ?>);'><i class="tf-ion-ios-heart"></i></a>
													</li>
													<li>
														<a onclick='addToCart(<?php echo $relatedData["id"]; ?>);'><i class="tf-ion-android-cart"></i></a>
													</li>
												</ul>
											</div>
										</div>
										<div class="product-content">
											<h4><a href="<?php echo "singleProductView.php?id=" . $relatedData["id"]; ?>"><?php echo $relatedData["title"]; ?></a></h4>
											<p class="price">$<?php echo $relatedData["price"]; ?></p>
										</div>
									</div>
								</div>

						<?php
							}
						}
						?>

					</div>
				</div>
			</section>



			<!-- Modal -->
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
			<script src="plugins/jquery/dist/jquery.min.js"></script>
			<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
			<script src="script.js"></script>
		</body>

		</html>
	<?php
	}
	?>
<?php
} else {
	echo ("Something Went Wrong");
}
?>