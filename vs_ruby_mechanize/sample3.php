<?php

require dirname(__DIR__).'/goutte.phar';
set_include_path(dirname(__DIR__).'/src/vendor/diggin/library/'. PATH_SEPARATOR . 
                 dirname(__DIR__).'/src/vendor/zf2/library/' . PATH_SEPARATOR .
                 dirname(__DIR__).'/src/vendor/pear/' . PATH_SEPARATOR .
                 dirname(__DIR__).'/src/');
require_once 'Zend/Loader/Autoloader.php';
$loader = \Zend\Loader\Autoloader::getInstance();
$loader->registerNamespace('Diggin_');
$loader->registerNamespace('Symfony');
$loader->registerNamespace('Rhizome');


try {
    $client = new \Rhizome\Client;
    $crawler = $client->get('http://musicrider.com/');

    $links = $crawler->filter('a')->links();

    foreach ($links as $link) echo $link->getUri();
    
} catch (\Exception $e) {
    print_r($e);
}

