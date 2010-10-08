<?php
include 'include.php';

try {
    $client = new \Rhizome\Client;
    $crawler = $client->get('http://diggin.musicrider.com/sample_html/basehead.html');

    $links = $crawler->filter('a')->links();

    foreach ($links as $link) var_dump($link->getUri(2));
    
} catch (\Exception $e) {
    print_r($e);
}

