<?php

namespace Listagame\Model;

/**
 * Comment
 * 
 * Set or get informations for a comment
 */

class Comment
{
    /**
     * @var int $_id the id of a comment
     */
    protected $_id;

    /**
     * @var int $_memberId the id of the member who wrote the comment
     */
    protected $_memberId;

    /**
     * @var int $_gameId the id of the game where the comment is displayed
     */
    protected $_gameId;

    /**
     * @var string $_content the content of a comment
     */
    protected $_content;

    /**
     * @var string $_creationDate the creation date of a comment
     */
    protected $_creationDate;

    /**
     * @var bool $_reported is true if comment is reported
     */
    protected $_reported;


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
     * Allows to get the id of a comment
     * 
     * @return int $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Allows to get the member id of a comment
     * 
     * @return int $_memberId
     */
    public function getMemberId()
    {
        return $this->_memberId;
    }

    /**
     * Allows to get the game id of a comment
     * 
     * @return int $_gameId
     */
    public function getGameId()
    {
        return $this->_gameId;
    }

    /**
     * Allows to get the content of a comment
     * 
     * @return string $_content
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Allows to get the creation date of a comment
     * 
     * @return string $_creationDate
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * Allows to know if a comment is reported
     * 
     * @return bool $_reported
     */
    public function getreported()
    {
        return $this->_reported;
    }


    // SETTERS

    /**
     * Allows to set the id of a comment
     * 
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Allows to set the member id of a comment
     * 
     * @param int $memberId
     */
    public function setMemberId(int $memberId)
    {
        $this->_memberId = $memberId;
    }

    /**
     * Allows to set the game id of a comment
     * 
     * @param int $gameId
     */
    public function setGameId(string $gameId)
    {
        $this->_gameId = $gameId;
    }

    /**
     * Allows to set the content of a comment
     * 
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->_content = $content;
    }

    /**
     * Allows to set the creation date of a comment
     * 
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    /**
     * Allows to set if a comment is reported
     * 
     * @param bool $reported
     */
    public function setReported($reported)
    {
        $this->_reported = $reported;
    }

}