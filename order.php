<?php $e = $_GET["e"];

require "connection.php";
$total = 0;
$invoice_rs = Database::search("SELECT*FROM `invoice`");
$invoice_num = $invoice_rs->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>SneeakerClub | Admin Panel | Order</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>

<body id="body">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Manage Items</h1>
					<ol class="breadcrumb">
						<li><a href="adminPanel.php">Admin</a></li>
						<li class="active">Order</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="user-dashboard page-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="list-inline dashboard-menu text-center">
						<li><a href="adminPanel.php">Dashboard</a></li>
						<li><a class="active" href="<?php echo "order.php?e=" . $adata["id"]; ?>">Orders</a></li>
						<li><a href="<?php echo "salesReport.php?e=" . $e; ?>">Sales Report</a></li>
						<li><a href="<?php echo "addItems.php?e=" . $e ?>">Add Itms</a></li>
						<li><a href="<?php echo "manageItems.php?e=" . $e; ?>">Manage items</a></li>
						<li><a href="<?php echo "manageusers.php?e=" . $e; ?>">Manage Users</a></li>
						<li><a href="<?php echo "adminProfile.php?e=" . $e; ?>">Profile Details</a></li>
					</ul>
					<div class="col-12 mt-5">
						<div class="row justify-content-center">
							<?php
							$irs = Database::search("SELECT*FROM `invoice`");
							$inum = $irs->num_rows; 

							for($a=0;$a<$inum;$a++){
								$iData = $irs->fetch_assoc();
								if ($iData["status"]==2) {
									$total = $total+$iData["total"];
								}
								
							}

							?>
							<div class="col-2 mx-2 border-1 bg-black border-dark text-center">
								<h5 class="fw-bolder text-light">Total Orders - <?php echo $inum ?></h5>
							</div>
							<div class="col-2 mx-2 p-1 border-1 bg-secondary border-dark text-center">
								<h5 class="fw-bolder text-light">Total Revenue - $<?php echo $total ?></h5>
							</div>
							<div class="col-2 p-1 mx-2 border-1 bg-success border-dark text-center">
								<?php
								$inrs = Database::search("SELECT*FROM `invoice` WHERE `status`=2");
								?>
								<h5 class="fw-bolder text-light"> Complete Orders - <?php echo $inrs->num_rows; ?></h5>
							</div>
							<div class="col-2 p-1 mx-2 border-1 bg-warning border-dark text-center">
							<?php
								$pendingrs = Database::search("SELECT*FROM `invoice` WHERE `status`=1");
								?>
								<h5 class="fw-bolder text-light">Pending Orders - <?php echo $pendingrs->num_rows; ?></h5>
							</div>
							<div class="col-2 p-1 mx-2 border-1 bg-danger border-dark text-center">
							<?php
								$cancelrs = Database::search("SELECT*FROM `invoice` WHERE `status`=3");
								?>
								<h5 class="fw-bolder text-light">Cancelled Orders - <?php echo $cancelrs->num_rows; ?></h5>
							</div>
						</div>
					</div>
					<div class="dashboard-wrapper user-dashboard">
						<div class="col-2 mt-3">
							<input type="search" id="search_order" class="form-control" onkeyup="searchOrder(event);" placeholder="Search..." />
						</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Date</th>
										<th>Items</th>
										<th>Total Price</th>
										<th>Status</th>
										<!-- <th></th> -->
									</tr>
								</thead>
								<tbody id="orderResultss">
									<?php
									for ($i = 0; $i < $invoice_num; $i++) {
										$invoiceData = $invoice_rs->fetch_assoc();
									?>
										<tr>
											<td><?php echo $invoiceData["order_id"]; ?></td>
											<td><?php echo $invoiceData["date"]; ?></td>
											<td><?php echo $invoiceData["qty"]; ?></td>
											<td>$<?php echo $invoiceData["total"]; ?></td>
											<?php

											if ($invoiceData["status"] == 1) {
											?>
												<td><span class="label label-warning">Pending</span></td>
											<?php
											} else if ($invoiceData["status"] == 2) {
											?>
												<td><span class="label label-success">Completed</span></td>
											<?php
											} else {
											?>
												<td><span class="label label-danger">Canceld</span></td>
											<?php
											}
											?>
											<!-- <td><button  class="btn btn-default" onclick='itemView("<?php echo $invoiceData["order_id"]; ?>");'>View</button></td> -->
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
					<p class="copyright-text">Copyright &copy;2021, Designed &amp; Developed by <a href="https://themefisher.com/">Themefisher</a></p>
				</div>
			</div>
		</div>
	</footer>
	<script src="script.js"></script>
</body>

</html>