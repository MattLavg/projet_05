<?php

namespace Listagame\Model;

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
    protected $_firstName;

    /**
     * @var string $_lastName, the last name of a member
     */
    protected $_lastName;

    /**
     * @var string $_nickName, the nick name of a member
     */
    protected $_nickName;

    /**
     * @var string $_mail, the mail of a member
     */
    protected $_mail;

    /**
     * @var string $_ipAddress, the IP address of a member
     */
    protected $_ipAddress;

    /**
     * @var string $_birthday, the birthday of a member
     */
    protected $_birthday;

    /**
     * @var string $_icon, the icon of a member
     */
    protected $_icon;

    /**
     * @var string $_inscriptionDate, the inscription date of a member
     */
    protected $_inscriptionDate;

    /**
     * @var string $_lastConnectionDate, the last connection date of a member
     */
    protected $_lastConnectionDate;

    /**
     * @var string $_password, the password of a member
     */
    protected $_password;

    /**
     * @var int $_type, the type of a member
     */
    protected $_type;

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
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * Allows to get the last name of a member
     * 
     * @return string $_lastName
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * Allows to get the nick name of a member
     * 
     * @return string $_nickName
     */
    public function getNickName()
    {
        return $this->_nickName;
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
     * Allows to get the IP address of a member
     * 
     * @return string $_ipAddress
     */
    public function getIpAddress()
    {
        return $this->_ipAddress;
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
     * Allows to get the icon of a member
     * 
     * @return string $_icon
     */
    public function getIcon()
    {
        return $this->_icon;
    }

    /**
     * Allows to get the inscription date of a member
     * 
     * @return string $_inscriptionDate
     */
    public function getInscriptionDate()
    {
        return $this->_inscriptionDate;
    }

    /**
     * Allows to get the last connection date of a member
     * 
     * @return string $_lastConnectionDate
     */
    public function getLastConnectionDate()
    {
        return $this->_lastConnectionDate;
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
    public function getType()
    {
        return $this->_type;
    }

 }