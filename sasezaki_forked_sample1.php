<?php

require 'goutte.phar';

use Goutte\Client as Goutte;
use Zend\Http\Response as ZendResponse;
use Symfony\Component\BrowserKit\Response;

set_include_path('src/vendor/diggin/library/');
require_once 'Diggin/Scraper/Adapter/Htmlscraping.php';

class Rhizome extends Goutte
{
    protected $_scraperAdapter;

    protected function createResponse(ZendResponse $response)
    {
        return new Response($this->getScraperAdapter()->getXhtml($response), $response->getStatus(), $response->getHeaders());
    }

    public function getScraperAdapter()
    {
        if (!$this->_scraperAdapter) {
            $adapter = new Diggin_Scraper_Adapter_Htmlscraping();
            $adapter->setConfig(array('pre_ampersand_escape' => false,
                                      'url' => $this->getRequest()->getUri()));
            $this->_scraperAdapter = $adapter;
        }

        return $this->_scraperAdapter;
    }
}



$client = new Rhizome;
$clawler = $client->request('GET', 'http://www.microsoft.com/japan/office/previous/2003/experience/workstyle/tips/word/tips9.mspx');

var_dump($clawler->filter('h2.subtitle')->text());
