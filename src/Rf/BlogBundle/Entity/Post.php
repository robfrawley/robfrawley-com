<?php

namespace Rf\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $posted;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $entry;


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
     * Set posted
     *
     * @param \DateTime $posted
     * @return Post
     */
    public function setPosted($posted)
    {
        $this->posted = $posted;
    
        return $this;
    }

    /**
     * Get posted
     *
     * @return \DateTime 
     */
    public function getPosted()
    {
        return $this->posted;
    }

    /**
     * Get posted formatted
     *
     * @return string
     */
    public function getPostedFormatted($format = 'r')
    {
        return $this->posted->format($format);
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Post
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set entry
     *
     * @param string $entry
     * @return Post
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;
    
        return $this;
    }

    /**
     * Get entry
     *
     * @return string 
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
