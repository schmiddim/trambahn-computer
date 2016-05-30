<?php
$colors = require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'colors.php';
$filterForStations = require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'filterForStations.php';
$searchForStations = require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'searchForStations.php';



echo '<pre>';
echo '==== Colors ===';
var_dump($colors);
echo '==== Filter for Stations ===';
var_dump($filterForStations);
echo '==== Search for Stations ===';
var_dump($searchForStations);
echo '</pre>';