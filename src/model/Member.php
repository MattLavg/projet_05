<?php

namespace App\Model;

/**
 * Member
 * 
 * Set or get informations for a member
 */

 class Member
 {
    /**
     * @var int $_id, the id of a member
    */
    protected $_id;

    /**
     * @var string $_firstName, the first name of a member
     */
    protected $_first_name;

    /**
     * @var string $_lastName, the last name of a member
     */
    protected $_last_name;

    /**
     * @var string $_nickName, the nick name of a member
     */
    protected $_nick_name;

    /**
     * @var string $_mail, the mail of a member
     */
    protected $_mail;

    /**
     * @var string $_birthday, the birthday of a member
     */
    protected $_birthday;

    /**
     * @var string $_inscriptionDate, the inscription date of a member
     */
    protected $_inscription_date;

    /**
     * @var string $_lastConnectionDate, the last connection date of a member
     */
    protected $_last_connection_date;

    /**
     * @var string $_password, the password of a member
     */
    protected $_password;

    /**
     * @var int $_type, the type of a member
     */
    protected $_id_type;

    /**
     * @var bool $_becoming_moderator, if member wants to be moderator
     */
    protected $_becoming_moderator;

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
     * Allows to get the id of a member
     * 
     * @return int $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Allows to get the first name of a member
     * 
     * @return string $_firstName
     */
    public function getFirst_name()
    {
        return $this->_first_name;
    }

    /**
     * Allows to get the last name of a member
     * 
     * @return string $_lastName
     */
    public function getLast_name()
    {
        return $this->_last_name;
    }

    /**
     * Allows to get the nick name of a member
     * 
     * @return string $_nickName
     */
    public function getNick_name()
    {
        return $this->_nick_name;
    }

    /**
     * Allows to get the mail of a member
     * 
     * @return string $_mail
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     * Allows to get the birthday of a member
     * 
     * @return string $_birthday
     */
    public function getBirthday()
    {
        return $this->_birthday;
    }

    /**
     * Allows to get the inscription date of a member
     * 
     * @return string $_inscriptionDate
     */
    public function getInscription_date()
    {
        return $this->_inscription_date;
    }

    /**
     * Allows to get the last connection date of a member
     * 
     * @return string $_lastConnectionDate
     */
    public function getLast_connection_date()
    {
        return $this->_last_connection_date;
    }

    /**
     * Allows to get the password of a member
     * 
     * @return string $_password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Allows to get the type of a member
     * 
     * @return int $_type
     */
    public function getId_type()
    {
        return $this->_id_type;
    }

    /**
     * Allows to get if member wants to be moderator
     * 
     * @return bool $_becoming_moderator
     */
    public function getBecoming_moderator()
    {
        return $this->_becoming_moderator;
    }

    // SETTERS

    /**
     * Allows to set the id of a member
     * 
     * @param int $_id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Allows to set the first name of a member
     * 
     * @param string $_firstName
     */
    public function setFirst_name(string $firstName = null)
    {
        $this->_first_name = $firstName;
    }

    /**
     * Allows to set the last name of a member
     * 
     * @param string $_lastName
     */
    public function setLast_name(string $lastName = null)
    {
        $this->_last_name = $lastName;
    }

    /**
     * Allows to set the nick name of a member
     * 
     * @param string $_nickName
     */
    public function setNick_name(string $nickName)
    {
        $this->_nick_name = $nickName;
    }

    /**
     * Allows to set the mail of a member
     * 
     * @param string $_mail
     */
    public function setMail(string $mail)
    {
        $this->_mail = $mail;
    }

    /**
     * Allows to set the birthday of a member
     * 
     * @param string $_birthday
     */
    public function setBirthday(string $birthday = null)
    {
        $this->_birthday = $birthday;
    }

    /**
     * Allows to set the inscription date of a member
     * 
     * @param string $_inscriptionDate
     */
    public function setInscription_date(string $inscriptionDate)
    {
        $this->_inscription_date = $inscriptionDate;
    }

    /**
     * Allows to set the last connection date of a member
     * 
     * @param string $_lastConnectionDate
     */
    public function setLast_connection_date(string $lastConnectionDate = null)
    {
        $this->_last_connection_date = $lastConnectionDate;
    }

    /**
     * Allows to set the password of a member
     * 
     * @param string $_password
     */
    public function setPassword(string $password)
    {
        $this->_password = $password;
    }

    /**
     * Allows to set the type of a member
     * 
     * @param int $_type
     */
    public function setId_type(int $idType = 3)
    {
        $this->_id_type = $idType;
    }

    /**
     * Allows to set if member wants to be moderator
     * 
     * @param bool $_becoming_moderator
     */
    public function setBecoming_moderator($becomingModerator)
    {
        $this->_becoming_moderator = $becomingModerator;
    }

 }