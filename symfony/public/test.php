<?php

use App\CouponParserPostgres;

require_once "symfony_start.php";

$db = [
    "vladivostok" => null,
    "artem" => null,
    "nahodka" => null,
    "ussuriysk" => null,
    "habarovsk" => null,
];

$tmp_parser = new CouponParserPostgres("vladivostok");
$count_coupons = $tmp_parser->inputData();
echo $count_coupons." купонов куплено в https://vladivostok.lovikupon.ru</br>";

$query = "SELECT * FROM vladivostok";
$connection = pg_connect("
            host={$tmp_parser->getDb()->getDbHost()} 
            port={$tmp_parser->getDb()->getDbPort()} 
            dbname={$tmp_parser->getDb()->getDbName()} 
            user={$tmp_parser->getDb()->getDbUser()} 
            password={$tmp_parser->getDb()->getDbPass()}
            ");
$result = pg_query($connection, $query);
while ($row = pg_fetch_array($result, NULL,PGSQL_ASSOC))
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
pg_close($connection);
