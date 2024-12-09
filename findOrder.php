<?php
require "connection.php";
$oid = $_GET["oid"];

if (!empty($oid)) {

    $invoice_rs = Database::search("SELECT*FROM `invoice` WHERE `order_id`='" . $oid . "'");
    $invoice_num = $invoice_rs->num_rows;

    if (0 < $invoice_num) {

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

    } else {
        echo (1);
    }
} else {
    echo (0);
}
