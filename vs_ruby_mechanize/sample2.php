<?php

include 'include.php';


try {
    $client = new \Rhizome\Client;
    foreach ($client->get('http://www.ruby-lang.org/ja/man/html/index.html')->filter('p') as $p) {
        var_dump($p->nodeValue);
    }
} catch (\Exception $e) {
    print_r($e);
}

