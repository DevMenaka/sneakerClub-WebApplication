<?php $e = $_GET["e"];
require "connection.php";
$item_rs = Database::search("SELECT * FROM `items` ORDER BY `date_time_added` DESC");
$item_num = $item_rs->num_rows;

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
  <link rel="stylesheet" href="css/bootstrap.css">
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
          <h1 class="page-name">Manage Itemas</h1>
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
            <li><a class="active" href="<?php echo "manageItems.php?e=" . $e; ?>">Manage items</a></li>
            <li><a href="<?php echo "manageusers.php?e=" . $e; ?>">Manage Users</a></li>
            <li><a href="<?php echo "adminProfile.php?e=" . $e; ?>">Profile Details</a></li>
          </ul>

          <div class="col-12 mt-5">
            <div class="row justify-content-center">
              <div class="col-2 mx-2 border-1 bg-black border-dark text-center">
                <h5 class="fw-bolder text-light">Total Items - <?php echo $item_num ?></h5>
              </div>
              <div class="col-2 mx-2 p-1 border-1 bg-danger border-dark text-center">
                <?php
                $qtyRs = Database::search("SELECT * FROM `items` WHERE `qty`=0");
                ?>
                <h5 class="fw-bolder text-light">Out OF Stock Items - <?php echo $qtyRs->num_rows;?></h5>
              </div>
              <div class="col-2 mx-2 p-1 border-1 bg-secondary border-dark text-center">
                <?php
                $lqtyRs = Database::search("SELECT * FROM `items` WHERE `qty`<5");
                ?>
                <h5 class="fw-bolder text-light">Low Quntity Items - <?php echo $lqtyRs->num_rows;?></h5>
              </div>
              <div class="col-2 p-1 mx-2 border-1 bg-success border-dark text-center">
                <?php
                $activers = Database::search("SELECT*FROM `items` WHERE `status`=1");
                ?>
                <h5 class="fw-bolder text-light"> Active Items - <?php echo $activers->num_rows; ?></h5>
              </div>
              <div class="col-2 p-1 mx-2 border-1 bg-warning border-dark text-center">
                <?php
                $deActivers = Database::search("SELECT*FROM `items` WHERE `status`=2");
                ?>
                <h5 class="fw-bolder text-dark">Deactive Items - <?php echo $deActivers->num_rows; ?></h5>
              </div>
            </div>
          </div>

          <div class="dashboard-wrapper user-dashboard">
            <div class="col-3 mb-3">
              <input type="search" id="search_manageItem" class="form-control" onkeyup="searchManageItem(event);" placeholder="Search..." />
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Item Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quntity</th>
                    <th class="col-md-2 col-sm-3">Ragisterd Date</th>
                    <th><a href="<?php echo "updateItem.php?e=" . $e; ?>">Update Items</a></th>
                    <th>Status</th>
                    <th></th>

                  </tr>
                </thead>
                <tbody id="findItem">

                  <?php
                  for ($x = 0; $x < $item_num; $x++) {
                    $idata = $item_rs->fetch_assoc();
                  ?>
                    <tr>
                      <td><?php echo $idata["id"]; ?></td>
                      <?php
                      $img_rs = Database::search("SELECT*FROM `images` WHERE `items_id`='" . $idata["id"] . "'");
                      $imgdata = $img_rs->fetch_assoc();
                      ?>
                      <td><img src="<?php echo $imgdata["path"]; ?>" style="height:70px; width:50px;" /></td>
                      <td><?php echo $idata["title"]; ?></td>
                      <td>$<?php echo $idata["price"]; ?></td>
                      <?php if (5 > $idata["qty"] && 1 <= $idata["qty"]) {
                      ?>
                        <td><span class="label text-warning fw-bolder"><?php echo $idata["qty"]; ?> Low Quntity!</span></td>
                      <?php
                      } elseif ($idata["qty"] == 0) {
                      ?>
                        <td><span class="label label-danger">Out Of Stock</span></td>
                      <?php
                      } else {
                      ?>
                        <td><?php echo $idata["qty"]; ?></td>
                      <?php
                      } ?>

                      <td><?php echo $idata["date_time_added"]; ?></td>
                      <td><a class="btn" href="<?php echo "updateItem.php?id=" . $idata["id"]; ?>"> <i class="tf-pencil2" aria-hidden="true"></i></a></td>


                      <?php if ($idata["status"] == 1) {
                      ?>
                        <td><button class="btn btn label-success">Active</button></td>
                      <?php
                      } else {
                      ?>
                        <td><button class="btn btn label-danger">Deactive</button></td>
                      <?php
                      } ?>

                      <?php if ($idata["status"] == 1) {
                      ?>
                        <td>
                          <button type="button" class="btn btn-warning" onclick="changeItemStatus(<?php echo $idata['id'] ?>)">Deactive</button>
                        </td>
                      <?php
                      } else {
                      ?>
                        <td>
                          <span><button type="button" class="btn btn-success" onclick="changeItemStatus(<?php echo $idata['id'] ?>)">Activate</span>
                        </td>
                      <?php
                      } ?>


                      <td>
                        <button type="button" class="btn btn-danger" onclick="RemoveItemFromPage(<?php echo $idata['id'] ?>)"><i class="tf-ion-close" aria-hidden="true"></i></button>
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

    <script src="script.js">
    </script>
</body>

</html>