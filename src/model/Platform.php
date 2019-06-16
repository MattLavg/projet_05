<?php

namespace App\Model;

/**
 * Platform
 * 
 * Set or get informations for a Platform
 */

class Platform
{
    /**
     * @var int $_id, the id of a Platform
     */
    protected $_id;

    /**
     * @var string $_name, the name of a Platform
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
     * Allows to get the id of a Platform
     * 
     * @return int $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Allows to get the name of a Platform
     * 
     * @return string $_name
     */
    public function getName()
    {
        return $this->_name;
    }

    // SETTERS

    /**
     * Allows to set the id of a Platform
     * 
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Allows to set the name of a Platform
     * 
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->_name = $name;
    }

}