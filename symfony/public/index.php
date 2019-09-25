<?php

use App\CouponParser;
use App\Database;

require_once "symfony_start.php";

$db = [
    "vladivostok" => null,
    "artem" => null,
    "nahodka" => null,
    "ussuriysk" => null,
    "habarovsk" => null,
    ];

$parser = [
    "vladivostok" => null,
    "artem" => null,
    "nahodka" => null,
    "ussuriysk" => null,
    "habarovsk" => null,
];


$tmp_parser = new CouponParser("vladivostok");
$count_coupons = $tmp_parser->inputData();
echo $count_coupons." купонов в https://vladivostok.lovikupon.ru</br>";
