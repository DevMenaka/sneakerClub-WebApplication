<?php
require "connection.php";
$id = $_GET["pid"];

if (0 < $id) {
    $irs = Database::search("SELECT * FROM `items` INNER JOIN `images` 
    ON items.id=images.items_id WHERE id ='" . $id . "'");
    $idata = $irs->fetch_assoc();
?>

    <div class="modal-body">
        <div class="row">
            <div class="col-6 col-xs-12">
                <div class="modal-image">
                    <img class="img-responsive" src="<?php echo $idata["path"];?>" alt="product-img" />
                </div>
            </div>
            <div class="col-6 col-xs-12">
                <div class="product-short-details">
                    <h2 class="product-title"><?php echo $idata["title"];?></h2>
                    <p class="product-price">$<?php echo $idata["price"];?></p>
                    <p class="product-short-description">
                    <?php echo $idata["description"];?>
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    echo ("error");
}

?>