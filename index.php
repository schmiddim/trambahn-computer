<?php

use Mvg\Factories\Departures as DeparturesFactory;
use TrambahnComputer\Departures as TrambahnComputerDepartures;
use Mvg\Parser\Html\Departures;
use Mvg\RequestHandler\Html\HttpGetDepartures;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';


$colors = require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'colors.php';
$departureConfig = require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'departures.php';

$outputArrays = array();
$outputArrays['lines'] = array();


foreach ($departureConfig as $departureItem) {
    $searchForStation = trim($departureItem['station']);
    $http = new HttpGetDepartures('http', 'www.mvg-live.de', 'ims/dfiStaticAuswahl.svc');
    $result = $http->getDeparturesForStation($searchForStation);
    $parser = new Departures($result);
    $departures = $parser->getDepartures();
    $factory = new DeparturesFactory($parser);

    $tramDepartures = new TrambahnComputerDepartures($factory, $colors, $departureItem['filterForStations']);
    $lineArray = $tramDepartures->getOutput();

    if (null !== $lineArray) {
        $outputArrays['lines'][] = $lineArray;
    }
}

$outputArrays['lineCount'] = count($outputArrays['lines']);

//ArduinoJson Library has trouble with unicode
ob_start();
echo iconv("UTF-8", "CP437", trim(json_encode($outputArrays)));
$content = ob_get_contents();
$length = strlen($content);
header('Content-Length: ' . $length);
