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
    public function checkLogin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT mail, password FROM members');

        $data = $req->fetch(\PDO::FETCH_ASSOC);
   
        return $data;
    }
}