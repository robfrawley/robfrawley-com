<?php

namespace Rf\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Welcome
 */
class Welcome
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $header;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $urlText;

    /**
     * @var string
     */
    private $urlHref;

    /**
     * @var string
     */
    private $matcher;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set header
     *
     * @param string $header
     * @return Welcome
     */
    public function setHeader($header)
    {
        $this->header = $header;
    
        return $this;
    }

    /**
     * Get header
     *
     * @return string 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Welcome
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set urlText
     *
     * @param string $urlText
     * @return Welcome
     */
    public function setUrlText($urlText)
    {
        $this->urlText = $urlText;
    
        return $this;
    }

    /**
     * Get urlText
     *
     * @return string 
     */
    public function getUrlText()
    {
        return $this->urlText;
    }

    /**
     * Set urlHref
     *
     * @param string $urlHref
     * @return Welcome
     */
    public function setUrlHref($urlHref)
    {
        $this->urlHref = $urlHref;
    
        return $this;
    }

    /**
     * Get urlHref
     *
     * @return string 
     */
    public function getUrlHref()
    {
        return $this->urlHref;
    }

    /**
     * Set matcher
     *
     * @param string $matcher
     * @return Welcome
     */
    public function setMatcher($matcher)
    {
        $this->matcher = $matcher;
    
        return $this;
    }

    /**
     * Get matcher
     *
     * @return string 
     */
    public function getMatcher()
    {
        return $this->matcher;
    }
}
