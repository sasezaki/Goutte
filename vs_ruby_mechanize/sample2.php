<?php

require dirname(__DIR__).'/goutte.phar';
set_include_path(dirname(__DIR__).'/src/vendor/diggin/library/'. PATH_SEPARATOR . 
                 dirname(__DIR__).'/src/vendor/zf2/library/' . PATH_SEPARATOR .
                 dirname(__DIR__).'/src/');
require_once 'Zend/Loader/Autoloader.php';
$loader = \Zend\Loader\Autoloader::getInstance();
$loader->registerNamespace('Diggin_');
$loader->registerNamespace('Symfony');
$loader->registerNamespace('Rhizome');


try {
    $client = new \Rhizome\Client;
    foreach ($client->get('http://www.ruby-lang.org/ja/man/html/index.html')->filter('p') as $p) {
        var_dump($p->nodeValue);
    }
} catch (\Exception $e) {
    print_r($e);
}

