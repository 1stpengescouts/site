<?php

use App\Env;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(Env::getRepository(),__DIR__);
$dotenv->load();
$dotenv->required([
    'DB_NAME',
    'DB_USER',
    'DB_PASS',
]);
