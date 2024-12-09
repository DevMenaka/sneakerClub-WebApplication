<?php

require "connection.php";

$txt = $_POST["t"];

$query = "SELECT * FROM `items`";

if (!empty($txt) != 0) {
	$query .= " WHERE `title` LIKE '%" . $txt . "%'";
} elseif (empty($txt) != 0) {
	$query .= " WHERE `description` LIKE '%" . $txt . "%'";
} elseif (!empty($txt) != 0) {
	$query .= " WHERE `description` LIKE '%" . $txt . "%' ";
}
?>
<div class="row">
	<?php
	$item_rs = Database::search($query);
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
						<img class="img-responsive" src="<?php echo $rimg_data["path"]; ?>" alt="product-img" style="height:500px;" />
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