<?php

namespace App\Model;

/**
 * Region
 * 
 * Set or get informations for a region
 */

class Region
{
    /**
     * @var int $_id, the id of a region
     */
    protected $_id;

    /**
     * @var string $_name, the name of a region
     */
    protected $_name;

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
     * Allows to get the id of a region
     * 
     * @return int $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Allows to get the name of a region
     * 
     * @return string $_name
     */
    public function getName()
    {
        return $this->_name;
    }

    // SETTERS

    /**
     * Allows to set the id of a region
     * 
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Allows to set the name of a region
     * 
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->_name = $name;
    }

}