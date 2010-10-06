<?php
namespace Rhizome;

use Zend\Http\Response as ZendResponse;
use Symfony\Component\BrowserKit\Response;
use Rhizome\DomCrawler\Crawler;

class Client extends \Goutte\Client
{
    protected $_scraperAdapter;

    protected function createResponse(ZendResponse $response)
    {
        return new Response($this->getScraperAdapter()->getXhtml($response), $response->getStatus(), $response->getHeaders());
    }

    public function getScraperAdapter()
    {
        if (!$this->_scraperAdapter) {
            require_once 'Diggin/Scraper/Adapter/Htmlscraping.php';
            $adapter = new \Diggin_Scraper_Adapter_Htmlscraping();
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

    //@override
    protected function createCrawlerFromContent($uri, $content, $type)
    {  
        $crawler = new Crawler(null, $uri);
        $crawler->addContent($content, $type);

        return $crawler;
    }

}
