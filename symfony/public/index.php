<?php

use App\CouponParser;

require_once "symfony_start.php";

$db = [
    "vladivostok" => null,
    "artem" => null,
    "nahodka" => null,
    "ussuriysk" => null,
    "habarovsk" => null,
    ];

$tmp_parser = new CouponParser("vladivostok");
$count_coupons = $tmp_parser->inputData();
echo $count_coupons." купонов куплено в https://vladivostok.lovikupon.ru</br>";

$query = "SELECT * FROM `vladivostok`";
$connection = new mysqli(
    $tmp_parser->getDb()->getDbHost(),
    $tmp_parser->getDb()->getDbUser(),
    $tmp_parser->getDb()->getDbPass(),
    $tmp_parser->getDb()->getDbName()
);
$result = $connection->query($query);
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    ?>
    <div class="coupon__field">
        <div class="coupon__header">
            <div class="coupon__validity"><p><?php echo $row["validity_text"] ?></p></div>
            <div class="coupon__end_sale"><p><?php echo $row["end_sale_date"] ?></p></div>
        </div>
        <div class="coupon__title"><p><a href="<?php echo $row["link"] ?>"><?php echo $row["title"] ?></a></p></div>
        <div class="coupon__image"><img src="<?php echo $row["src_image"] ?>"></div>
    </div>
    <?php
}
$connection->close();
