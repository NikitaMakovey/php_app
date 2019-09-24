<?php

use App\Database;

require_once "symfony_start.php";

$db = [
    "vladivostok" => null,
    "artem" => null,
    "nahodka" => null,
    "ussuriysk" => null,
    "habarovsk" => null,
    ];

foreach ($db as $k => $v)
{
    $db[$k] = new Database($k);
}
