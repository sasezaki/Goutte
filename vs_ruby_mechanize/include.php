<?php

require dirname(__DIR__).'/goutte.phar';
set_include_path(
                 dirname(__DIR__).'/src/vendor/zf1/library/' . PATH_SEPARATOR .
                 dirname(__DIR__).'/src/vendor/zf2/library/' . PATH_SEPARATOR .
                 dirname(__DIR__).'/src/vendor/diggin/library/'. PATH_SEPARATOR . 
                 dirname(__DIR__).'/src/vendor/pear/' . PATH_SEPARATOR .
                 dirname(__DIR__).'/src/');

require_once 'Diggin/Http/Response/Charset.php';

use Symfony\Framework\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony' => dirname(__DIR__).'/src/vendor/symfony/src',
    'Zend'    => dirname(__DIR__).'/src//vendor/zend/library',
    'Rhizome'  => dirname(__DIR__).'/src/',
));
$loader->register();


