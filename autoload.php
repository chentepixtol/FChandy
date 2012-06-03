<?php

$loader = require_once 'vendor/autoload.php';

$loader->add('Test', realpath('.'));
$loader->register();
