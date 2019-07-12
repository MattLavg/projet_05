<?php

namespace App\Model;

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
    protected $_id_member;

    /**
     * @var string $_member_nick_name the nickname of the member who wrote the comment
     */
    protected $_member_nick_name;

    /**
     * @var int $_member_id_type the member's type
     */
    protected $_member_id_type;

    /**
     * @var int $_gameId the id of the game where the comment is displayed
     */
    protected $_id_game;

    /**
     * @var string $_content the content of a comment
     */
    protected $_content;

    /**
     * @var string $_creationDate the creation date of a comment
     */
    protected $_creation_date;

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
        return $this->_id_member;
    }

    /**
     * Allows to get the member nickname of a comment
     * 
     * @return int $_member_nick_name
     */
    public function getMemberNickName()
    {
        return $this->_member_nick_name;
    }

    /**
     * Allows to get the member type of a comment
     * 
     * @return int $_member_id_type
     */
    public function getMemberType()
    {
        return $this->_member_id_type;
    }

    /**
     * Allows to get the game id of a comment
     * 
     * @return int $_gameId
     */
    public function getGameId()
    {
        return $this->_id_game;
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
        return $this->_creation_date;
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
        $this->_id_member = $memberId;
    }

    /**
     * Allows to set the member nickname of a comment
     * 
     * @param int $member_nick_name
     */
    public function setMemberNickName(string $memberNickName)
    {
        $this->_member_nick_name = $memberNickName;
    }

    /**
     * Allows to set the member type of a comment
     * 
     * @param int $member_id_type
     */
    public function setMemberType(int $memberType)
    {
        $this->_member_id_type = $memberType;
    }

    /**
     * Allows to set the game id of a comment
     * 
     * @param int $gameId
     */
    public function setGameId(int $gameId)
    {
        $this->_id_game = $gameId;
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
        $this->_creation_date = $creationDate;
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