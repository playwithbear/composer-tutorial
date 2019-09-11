<?php

require_once 'vendor/autoload.php';

use League\Csv\Reader;
use GuzzleHttp\Client;

//load the CSV document from a file path
$csv = Reader::createFromPath('MOCK_DATA.csv', 'r');
$csv->setHeaderOffset(0);

$header = $csv->getHeader(); //returns the CSV header record
$records = $csv->getRecords(); //returns all the CSV records as an Iterator object

// Headers: id, first_name, last_name, email, gender, ip_address

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://requestbin.net/r/1gl24891',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);

foreach ($records as $r) {
    $info = json_encode($r);
    $client->request('POST', 'http://requestbin.net/r/1gl24891', [
        'body' => $info
    ]);
}