<?php
$e = $_GET["e"];

require "connection.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>SneakerClub | Manage Members</title>
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="body">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="content">
          <h1 class="page-name">Manage Members</h1>
          <ol class="breadcrumb">
            <li><a href="adminPanel.php">Dashboard</a></li>
            <li class="active">my account</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  </section>
  <section class="user-dashboard page-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="list-inline dashboard-menu text-center">
            <li><a href="adminPanel.php">Dashboard</a></li>
            <li><a href="<?php echo "order.php?e=" . $e ?>">Orders</a></li>
            <li><a href="<?php echo "salesReport.php?e=" . $e; ?>">Sales Report</a></li>
            <li><a href="<?php echo "addItems.php?e=" . $e ?>">Add Itms</a></li>
            <li><a href="<?php echo "manageItems.php?e=" . $e; ?>">Manage items</a></li>
            <li><a class="active" href="<?php echo "manageusers.php?e=" . $e; ?>">Manage Users</a></li>
            <li><a href="<?php echo "adminProfile.php?e=" . $e; ?>">Profile Details</a></li>
          </ul>

          <div class="col-12 mt-5">
            <div class="row justify-content-center">
              <div class="col-2 mx-2 border-1 bg-black border-dark text-center">
              <?php
                $mrs = Database::search("SELECT * FROM `members` ");
                ?>
                <h5 class="fw-bolder text-light">Total Members - <?php echo $mrs->num_rows; ?></h5>
              </div>
              <?php
                $umrs = Database::search("SELECT * FROM `members` WHERE 0<`mobile` ");
                ?>
              <div class="col-2 mx-2 p-1 border-1 bg-info border-dark text-center">
                <h5 class="fw-bolder text-light">Update Members - <?php echo $umrs->num_rows; ?></h5>
              </div>
              <?php
                $umrs = Database::search("SELECT * FROM `members` WHERE `mobile`=0 ");
                ?>
              <div class="col-2 mx-2 p-1 border-1 bg-warning border-dark text-center">
                <h5 class="fw-bolder text-dark">Not Updated Members - <?php echo $umrs->num_rows; ?></h5>
              </div>
              <div class="col-2 p-1 mx-2 border-1 bg-success border-dark text-center">
                <?php
                $activers = Database::search("SELECT*FROM `members` WHERE `status`=1");
                ?>
                <h5 class="fw-bolder text-light"> Active Members - <?php echo $activers->num_rows; ?></h5>
              </div>
              <div class="col-2 p-1 mx-2 border-1 bg-danger border-dark text-center">
                <?php
                $deActivers = Database::search("SELECT*FROM `members` WHERE `status`=2");
                ?>
                <h5 class="fw-bolder text-light">Deactive Members - <?php echo $deActivers->num_rows; ?></h5>
              </div>
            </div>
          </div>

          <div class="dashboard-wrapper user-dashboard">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th class="col-md-2 col-sm-3">Phone</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  $mrs = Database::search("SELECT*FROM `members` ORDER BY `signup_date`  ASC");
                  $mnum = $mrs->num_rows;

                  for($x=0;$x<$mnum;$x++){

                    $mdata = $mrs->fetch_assoc();
                    ?>
                  <tr>
                    <td><?php echo $mdata["email"];?></td>
                    <td><?php echo $mdata["fname"]." ".$mdata["lname"];?></td>
                    <?php
                     $addressRs = Database::search("SELECT * FROM `member_has_adress` WHERE `member_mail`='".$mdata["email"]."'");
                     $addressNum = $addressRs->num_rows;
                     $addressData = $addressRs->fetch_assoc();

                     if (0<$addressNum) {
                      ?>
                    <td><?php echo $addressData["line1"];?></td>
                    <?php
                     }else{
                      ?>
                      <td class="bg-warning">Address Is Not Updated !!</td>
                      <?php
                     }
                    ?>
                    <?php
                    if(0<$mdata["mobile"]){
                      ?>
                    <td><?php echo $mdata["mobile"];?></td>
                    <?php
                    }else{
                      ?>
                      <td class="bg-warning">Mobile Is Not Update !!</td>
                      <?php
                    }
                    ?>
                    <?php
                     if ($mdata["status"]==1) {
                      ?>
                    <td class="text-white bg-success fw-bolder">Active</td>
                    <?php
                     }else{
                      ?>
                      <td class="text-white bg-danger fw-bolder">Deactive</td>
                      <?php
                     }
                    ?>
                    <td>
                      <div class="btn-group" role="group">
                      <?php
                     if ($mdata["status"]==1) {
                      ?>
                    <button onclick='changeMameberStatus("<?php echo $mdata["email"]?>")' type="button" class="btn btn-default btn-warning"><i class="bi bi-lock-fill"></i></button>
                    <?php
                     }else{
                      ?>
                      <button onclick='changeMameberStatus("<?php echo $mdata["email"]?>")' type="button" class="btn btn-default btn-success"><i class="bi bi-unlock-fill"></i></button>
                      <?php
                     }
                    ?>
                        <button onclick='removeMameber("<?php echo $mdata["email"]?>")' type="button" class="btn btn-default btn-danger"><i class="tf-ion-close" aria-hidden="true"></i></button>
                      </div>
                    </td>
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
          <p class="copyright-text">Copyright &copy;2023, Designed &amp; Developed by <a href="">Menaka Siriwardhana</a></p>
        </div>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
</body>

</html>