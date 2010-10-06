<?php
require dirname(__DIR__).'/goutte.phar';
require dirname(__DIR__). '/src/Rhizome/Client.php';
set_include_path(dirname(__DIR__).'/src/vendor/diggin/library/'. PATH_SEPARATOR. dirname(__DIR__).'/src/vendor/zf2/library/');
require_once 'Diggin/Scraper/Adapter/Htmlscraping.php';

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

