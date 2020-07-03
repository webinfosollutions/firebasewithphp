<?php

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
exit;
$factory = (new Factory())
    ->withDatabaseUri('https://phpwithfirebase-53e56.firebaseio.com/');

$database = $factory->createDatabase();


echo "<pre>";print_r($database);exit;