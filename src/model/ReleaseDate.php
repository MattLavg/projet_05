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
     * @var int $_platform_id, the platform id of a game for one release
     */
    protected $_platform_id;

    /**
     * @var string $_platform, the platform of a game for one release
     */
    protected $_platform;

    /**
     * @var int $_region_id, the region id of a game for one release
     */
    protected $_region_id;

    /**
     * @var string $_region, the region of a game for one release
     */
    protected $_region;

    /**
     * @var int $_publisher_id, the publisher id of a game for one release
     */
    protected $_publisher_id;

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
     * Allows to get the platform id of a game for one release
     * 
     * @return int $_platform_id
     */
    public function getPlatformId()
    {
        return $this->_platform_id;
    }

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
     * Allows to get the region id of a game for one release
     * 
     * @return int $_region_id
     */
    public function getRegionId()
    {
        return $this->_region_id;
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
     * Allows to get the publisher id of a game for one release
     * 
     * @return int $_publisher_id
     */
    public function getPublisherId()
    {
        return $this->_publisher_id;
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
     * Allows to set the platform id of a game for one release
     * 
     * @param int $platform_id
     */
    public function setPlatformId(int $platform_id)
    {
        $this->_platform_id = $platform_id;
    }

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
     * Allows to set the region id of a game for one release
     * 
     * @param int $region_id
     */
    public function setRegionId(int $region_id)
    {
        $this->_region_id = $region_id;
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
     * Allows to set the publisher id of a game for one release
     * 
     * @param int $publisher_id
     */
    public function setpublisherId(int $publisher_id)
    {
        $this->_publisher_id = $publisher_id;
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