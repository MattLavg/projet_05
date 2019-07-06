<?php

namespace App\Model;

use App\Core\Manager;

/**
 * Authentication
 * 
 * Allows to check the login in the database
 */

class Authentication extends Manager
{
    /**
     * Allows to check the login in the database
     * 
     * @return array $data
     */
    public function checkLogin($member_mail)
    {
        $req = $this->_db->prepare('SELECT mail, password FROM members WHERE mail = ?');
        $req->execute(array($member_mail));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }
}