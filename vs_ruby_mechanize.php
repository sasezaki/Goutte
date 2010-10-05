<?php

require 'goutte.phar';

use Goutte\Client as Goutte;
use Zend\Http\Response as ZendResponse;
use Symfony\Component\BrowserKit\Response;

set_include_path('src/vendor/diggin/library/'. PATH_SEPARATOR. 'src/vendor/zf2/library/');
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

    /**
     * $server is request-header
     */
    public function get($uri, array $parameters = array(), array $files = array(), array $server = array(), $changeHistory = true)
    {
        return $this->request('GET', $uri, $parameters, $files, $server, $changeHistory);
    }

    public function __call($method, $args)
    {}
}


try {
    $client = new Rhizome;
    // Acces Google
    $clawler = $client->request('GET', 'http://www.google.com/');

    var_dump( $clawler->filter('title')->text());

    // $crawler looks like mechanize's page
    var_dump( $client->get('http://www.yahoo.co.jp/')->filter('title')->text());


} catch (\Exception $e) {
    print_t($e);
}

