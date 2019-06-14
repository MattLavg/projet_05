<?php

namespace App\model;

/**
 * Developer
 * 
 * Set or get informations for a developer
 */

 class ReleaseDate
 {
    /**
     * @var string $_platform, the platform of a game for one release
     */
    protected $_platform;

    /**
     * @var string $_region, the region of a game for one release
     */
    protected $_region;

    /**
     * @var string $_publisher, the publisher of a game for one release
     */
    protected $_publisher;

    /**
     * @var string $_releaseDate, the release date of a game for one platform, region and publisher
     */
    protected $_releaseDate;

    /**
     * Set automatically elements in methods
     * 
     * @param array $data
     */
    public function hydrate($data)
    {   
        foreach ($data as $key => $value) {

            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS

    /**
     * Allows to get the platform of a game for one release
     * 
     * @return string $_platform
     */
    public function getPlatform()
    {
        return $this->_platform;
    }

    /**
     * Allows to get the region of a game for one release
     * 
     * @return string $_region
     */
    public function getRegion()
    {
        return $this->_region;
    }

    /**
     * Allows to get the publisher of a game for one release
     * 
     * @return string $_publisher
     */
    public function getPublisher()
    {
        return $this->_publisher;
    }

    /**
     * Allows to get the release date for a game for one platform, region and publisher
     * 
     * @return string $_releaseDate
     */
    public function getReleaseDate()
    {
        return $this->_releaseDate;
    }

    // SETTERS

    /**
     * Allows to set the platform of a game for one release
     * 
     * @param string $platform
     */
    public function setPlatform(string $platform)
    {
        $this->_platform = $platform;
    }

    /**
     * Allows to set the region of a game for one release
     * 
     * @param string $region
     */
    public function setRegion(string $region)
    {
        $this->_region = $region;
    }

    /**
     * Allows to set the publisher of a game for one release
     * 
     * @param string $publisher
     */
    public function setPublisher(string $publisher)
    {
        $this->_publisher = $publisher;
    }

    /**
     * Allows to set the release date for a game for one platform, region and publisher
     * 
     * @param string $releaseDate
     */
    public function setReleaseDate(string $releaseDate)
    {
        $this->_releaseDate = $releaseDate;
    }

 }