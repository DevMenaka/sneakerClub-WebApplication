<?php
session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

	$adata = $_SESSION["au"];

?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
		<title>SneeakerClub | Admin Panel</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
		<link rel="stylesheet" href="plugins/themefisher-font/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
		<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body id="body">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="content">
						<h1 class="page-name">Dashboard</h1>
						<ol class="breadcrumb">
							<li><a onclick="Adminsignout();" style="cursor:pointer;">Log Out</a></li>
							<li class="active">Admin Panel</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		</section>

		<?php $email = $adata["email"]; ?>

		<section class="user-dashboard page-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="list-inline dashboard-menu text-center">
							<li><a class="active" href="adminPanel.php">Dashboard</a></li>
							<li><a href="<?php echo "order.php?e=" . $adata["id"]; ?>">Orders</a></li>
							<li><a href="<?php echo "salesReport.php?e=" . $adata["id"]; ?>">Sales Report</a></li>
							<li><a href="<?php echo "addItems.php?e=" . $adata["id"]; ?>">Add Itms</a></li>
							<li><a href="<?php echo "manageItems.php?e=" . $adata["id"]; ?>">Manage items</a></li>
							<li><a href="<?php echo "manageusers.php?e=" . $adata["id"]; ?>">Manage Users</a></li>
							<li><a href="<?php echo "adminProfile.php?e=" . $adata["id"]; ?>">Profile Details</a></li>
						</ul>

						<div class="dashboard-wrapper user-dashboard">
							<div class="col-12">
								<div class="row">
									<div class="col-lg-1 col-3">
										<?php
										$image_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_id`='" . $adata["id"] . "'");
										$image_data = $image_rs->fetch_assoc();
										if (empty($image_data["url"])) {
										?>
											<img class="rounded-circle" src="images/admin.svg" id="viweImage" style="height:100px; width:100px;" />
										<?php

										} else {
										?>
											<img src="<?php echo $image_data["url"]; ?>" class="rounded-circle" style="height:100px; width:100px;" id="viweImage" />
										<?php
										}
										?>

									</div>
									<div class="col-lg-4 col-4 mt-5 py-4">
										<?php if (empty($adata["fname"])) {
										?>
											<h2 class="media-heading px-5 px-lg-5">Welcome <span class="fs-5 text-bg-warning text-danger">Please Update Your Profile!!</span></h2>

										<?php
										} else {
										?>
											<h2 class="media-heading px-5 px-lg-5">Welcome <?php echo $adata["fname"] . " " . $adata["lname"]; ?></h2>

										<?php
										}
										?>
									</div>
								</div>
							</div>
							<div class="total-order mt-5">
								<h4>Manage Admin</h4>
								<div class="col-1">
									<h4 class="badge rounded-0 btn active" onclick="adminModel();"><i class="bi bi-person-plus-fill"></i> Add</h4>
								</div>
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Admin Email</th>
												<th>Status</th>
												<th>Change Status</th>
												<th>Remove</th>
											</tr>
										</thead>
										<tbody>
											<?php $admin_rs = Database::search("SELECT * FROM `admin` INNER JOIN `status` ON 
											admin.status_id = status.id");
											$atable = $admin_rs->num_rows;

											for ($x = 0; $x < $atable; $x++) {

												$admin_data = $admin_rs->fetch_assoc();
											?>
												<tr>
													<td><?php echo $admin_data["email"]; ?></td>
													<?php if ($admin_data["status_id"] == 1) {
													?>
														<td class="fw-bold text-success">Active</td>
													<?php
													} else {
													?>
														<td class="fw-bold text-danger">Deactive</td>
													<?php
													} ?>
													<?php
													if ($adata["email"] != $admin_data["email"]) {
													?>
														<?php if ($admin_data["status_id"] == 1) {
														?>
															<td><span class="label btn label-danger" onclick='adminActive("<?php echo $admin_data["email"] ?>");'>Deactive</span></td>
														<?php
														} else {
														?>
															<td><span class="label btn label-success" onclick='adminActive("<?php echo $admin_data["email"] ?>");'>Active</span></td>
														<?php
														}
														?>
														<td><span onclick='removeAdmin("<?php echo $admin_data["id"]?>");' class="label label-danger btn"><i class="bi bi-x-lg"></span></i></td>

													<?php
													} else {
													?>
														<td><span class="label text-dark label-warning fw-bolder">!</span></td>
														<td><span class="label text-dark label-warning  fw-bolder">!</span></td>
													<?php
													}
													?>
												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
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
						<p class="copyright-text">Copyright &copy;2022 &amp; Developed by <a href="https://themefisher.com/">Menaka</a></p>
					</div>
				</div>
			</div>
		</footer>

		<div class="modal" tabindex="-1" id="addAdminModel">
			<div class="modal-dialog">
				<div class="modal-content rounded-0">
					<div class="modal-header">
						<h5 class="modal-title">Add New Admin</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row g-3">

							<div class="col-12">
								<label class="form-lable">New Admin Email</label>
								<input type="email" class="form-control fs-4" id="newAdminEmail" />

							</div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" onclick="sendAdminRequest();">Finish</button>
					</div>
				</div>
			</div>
		</div>

		<script src="script.js"></script>
		<script src="bootstrap.bundle.js"></script>
	</body>

	</html>

<?php
}
?>