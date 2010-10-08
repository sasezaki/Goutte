<?php
namespace Rhizome\DomCrawler;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

class Crawler extends SymfonyCrawler
{
    //@override
    public function link($method = 'get')
    {
        if (!count($this)) {
            throw new \InvalidArgumentException('The current node list is empty.');
        }

        $node = $this->getNode(0);

        return new Link($node, $method, $this->host, $this->path);
    }

    //@override
    public function links()
    {  
        $links = array();
        foreach ($this as $node) {
            $links[] = new Link($node, 'get', $this->host, $this->path);
        }

        return $links;
    }

    //debug
    //public function getNode($pos)
    //{
    //    return parent::getNode($pos);   
    //}
}
