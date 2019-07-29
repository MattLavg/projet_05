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
     * @var bool $_updated_by_member, if a member modification is in progress
     */
    protected $_updated_by_member;

    /**
     * @var bool $_to_validate, if a member add a game
     */
    protected $_to_validate;

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

    /**
     * Allows to know if the game is modified by a member and waiting for validation
     * 
     * @return bool $_updated_by_member
     */
    public function getUpdated_by_member()
    {
        return $this->_updated_by_member;
    }

    /**
     * Allows to know if the game has been added by a member
     * 
     * @return bool $_to_validate
     */
    public function getTo_validate()
    {
        return $this->_to_validate;
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

    /**
     * Allows to set if the game is modified by a member and is waiting for validation
     * 
     * @param bool $updatedByMember
     */
    public function setUpdated_by_member(bool $updatedByMember = null)
    {
        $this->_updated_by_member = $updatedByMember;
    }

    /**
     * Allows to set if the game has been added by a member
     * 
     * @param bool $to_validate
     */
    public function setTo_validate(bool $toValidate = null)
    {
        $this->_to_validate = $toValidate;
    }

}