<?php
include 'include.php';

try {
    $client = new Rhizome\Client;
    // Acces Google
    $clawler = $client->request('GET', 'http://www.google.com/');

    var_dump( $clawler->filter('title')->text());

    // $crawler looks like mechanize's page
    var_dump( $client->get('http://www.yahoo.co.jp/')->filter('title')->text());


} catch (\Exception $e) {
    print_r($e);
}

