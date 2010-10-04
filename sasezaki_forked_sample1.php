<?php

require 'goutte.phar';

use Goutte\Client as Goutte;
use Zend\Http\Response as ZendResponse;
use Symfony\Component\BrowserKit\Response;

set_include_path('src/vendor/diggin/library/');
require_once 'Diggin/Scraper/Adapter/Htmlscraping.php';

class Rhizome extends Goutte
{
    protected function createResponse(ZendResponse $response)
    {
        // response adapter
        $adapter = new Diggin_Scraper_Adapter_Htmlscraping();
        return new Response($adapter->getXhtml($response), $response->getStatus(), $response->getHeaders());
    }
}



$client = new Rhizome;
$clawler = $client->request('GET', 'http://www.microsoft.com/japan/office/previous/2003/experience/workstyle/tips/word/tips9.mspx');

var_dump($clawler->filterXpath('//html')->text());
