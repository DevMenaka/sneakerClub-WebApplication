<?php
require "connection.php";

$txt = $_GET["keyWord"];

$query = "SELECT * FROM `items`";

if(!empty($txt) != 0) {
    $query .= " WHERE `id` LIKE '%" . $txt . "%' ";
}else if (!empty($txt)!=0){
    $query .= " WHERE `title` LIKE '%" . $txt . "%'";
}else {
    echo (0);
}

$item_rs = Database::search($query);
$item_num = $item_rs->num_rows;
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
        <td>Rs.<?php echo $idata["price"]; ?>.00</td>
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
                <span><button type="button" class="btn btn-dark" onclick="changeItemStatus(<?php echo $idata['id'] ?>)">Activate</span>
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