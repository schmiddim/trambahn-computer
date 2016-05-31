<?php
$colors = require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'colors.php';
$departures = require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'departures.php';


echo '<pre>';
echo '==== Colors ===';
var_dump($colors);
echo '==== Departures ===';
var_dump($departures);

echo '</pre>';