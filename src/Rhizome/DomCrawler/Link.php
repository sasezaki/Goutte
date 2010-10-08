<?php
namespace Rhizome\DomCrawler;

class Link extends \Symfony\Component\DomCrawler\Link
{
    const URI_ABSOLUTE_FALSE = 0;
    const URI_ABSOLUTE_TRUE = 1;
    const URI_ABSOLUTE_BASETAG = 2;

    protected $_uriHandler;

    public function getUri($absolute = true)
    {
        if (static::URI_ABSOLUTE_BASETAG === $absolute) {
            require_once 'Diggin/Scraper/Helper/Simplexml/HeadBaseHref.php';
            $simplexml = simplexml_import_dom($this->getNode()); // @todo create Diggin_Scraper_Helper_Dom*
            $headbase = new \Diggin_Scraper_Helper_Simplexml_HeadBaseHref($simplexml, array('preAmpFilter' => false,
                                                                                            /**'baseUrl' => */));
            $baseUrl = $headbase->getBaseUrl();

            if ($baseUrl) {
                $uriHander = $this->_getUriHandler();
                $uriHander->setBaseUri($baseUrl);
                return $uriHander->getAbsoluteUrl($this->node->getAttribute('href'));
            }
        }

        return parent::getUri($absolute);
    }

    protected function _getUriHandler()
    {
        if (!$this->_uriHandler) {
            require_once 'Diggin/Uri/Http.php';
            $this->_uriHandler = new \Diggin_Uri_Http;
        }

        return clone $this->_uriHandler;
    }
}
