<?php

namespace App\Model;

/**
 * Game
 * 
 * Set or get informations for a game
 */

class Game
{
    /**
     * @var int $_id, the id of a game
     */
    protected $_id;

    /**
     * @var string $_name, the name of a game
     */
    protected $_name;

    /**
     * @var string $_content, the description of a game
     */
    protected $_content;

    /**
     * @var string $_cover_extension, the cover extension of a game
     */
    protected $_cover_extension;

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
     * Allows to get the id of a game
     * 
     * @return int $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Allows to get the name of a game
     * 
     * @return string $_name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Allows to get the description of a game
     * 
     * @return string $_content
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Allows to get the cover extension of a game
     * 
     * @return string $_cover_extension
     */
    public function getCover_extension()
    {
        return $this->_cover_extension;
    }

    // SETTERS

    /**
     * Allows to set the id of a game
     * 
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Allows to set the name of a game
     * 
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->_name = $name;
    }

    /**
     * Allows to set the description of a game
     * 
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->_content = $content;
    }

    /**
     * Allows to set the cover extension of a game
     * 
     * @param string $cover_extension
     */
    public function setCover_extension(string $coverExtension)
    {
        $this->_cover_extension = $coverExtension;
    }

}