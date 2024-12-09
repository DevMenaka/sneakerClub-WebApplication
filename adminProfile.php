<?php
require "connection.php";
$e = $_GET["e"];
?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <title>SneakerClub | E-commerce template</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Constra HTML Template v1.0">
  <link rel="shortcut icon" type="image/x-icon" href="images/logo-no-background.svg" />
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <link rel="stylesheet" href="css/bootstrap.css"/>
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick/slick-theme.css">
  <link rel="stylesheet" href="css/style.css">
  

</head>

<body id="body">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="content">
          <h1 class="page-name">Admin Profile</h1>
          <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
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
            <li><a href="<?php echo "manageusers.php?e=" . $e; ?>">Manage Users</a></li>
            <li><a class="active" href="<?php echo "adminProfile.php?e=" . $e; ?>">Profile Details</a></li>
          </ul>
          <div class="dashboard-wrapper dashboard-user-profile">
            <div class="media">
              <div class="pull-left text-center col-9 col-md-3">
                <?php
                $image_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_id`='".$e."'");
                $image_data=$image_rs->fetch_assoc();
                if (empty($image_data["url"])) {
                ?>
                  <img class="rounded-circle" src="images/admin.svg" id="viweImage" style="height:150px; width:150px;"/>
                <?php

                } else {
                ?>
                  <img src="<?php echo $image_data["url"];?>" class="rounded-circle" style="height:150px; width:150px;" id="viweImage"/>
                <?php
                }
                ?>
                <input type="file" class="d-none" id="profileimg" accept="image/*" />
                <label for="profileimg" class="btn btn-transparent fw-bolder mt-20" onclick="changeImage();">Update Profile Image</label>
              </div>
              <div class="media-body col-6">
                <?php
                $admin_rs = Database::search("SELECT * FROM `admin` INNER JOIN `status` ON
               admin.status_id=status.id WHERE admin.id='" . $e . "'");
                $adminData = $admin_rs->fetch_assoc();
                ?>
                <ul class="user-profile-list">
                  <li><span>First Name:</span>
                    <div><input class="form-control" value="<?php echo $adminData["fname"]; ?>" type="text" style="height:30px;" id="fname"></div>
                  </li>
                  <li><span>Last:</span>
                    <div><input class="form-control" value="<?php echo $adminData["lname"]; ?>" type="text" style="height:30px;" id="lname"></div>
                  </li>
                  <li><span>Email:</span>
                    <div><input class="form-control" value="<?php echo $adminData["email"]; ?>" type="text" style="height:30px;" id="email"></div>
                  </li>
                  <li><span>Verification:</span>
                    <div><input class="form-control" value="<?php echo $adminData["vcode"]; ?>" type="text" style="height:30px;" disabled></div>
                  </li>
                  <li><span>Verification:</span><?php echo $adminData["name"]; ?></li>
                  <li>
                    <div><button class="btn btn-success" onclick="updateAdminprofile(<?php echo $e?>)">Update My Profile</button></div></span>
                  </li>
                </ul>
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
          <p class="copyright-text">Copyright &copy;2021, Designed &amp; Developed by <a href="https://themefisher.com/">Themefisher</a></p>
        </div>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
</body>

</html>