<?php

namespace App\Core;

use App\Core\Registry;
use App\Model\Game;

/**
 *  Manager
 * 
 *  Get the database connection
 */

abstract class Manager
{
    /**
     * @var string $_table
    */
    protected $_table;

    /**
     * @var string $_class
    */
    protected $_class;

    /**
     * @var string $_db
    */
    protected $_db;

    /**
     * Set the database connexion to the attribute $_db
     */
    public function __construct()
    {
        $this->_db = $this->dbConnect();
    }

    /**
     * Set the database connection in variable $db
     * 
     * @return object $db
     */
    protected function dbConnect()
    {
        $db = Registry::getDb();
        return $db;
    }

    /**
     * Get all the rows from a table
     * 
     * @return array $array
     */
    public function getAll()
    {
        $class = $this->_class;
        $req = $this->_db->query('SELECT * FROM ' . $this->_table . ' ORDER BY id DESC');

        $array = [];

        if ($req) {

            while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

                $object = new $class();
                $object->hydrate($data);
    
                $array[] = $object;
    
            }
        }

        return $array;
    }

}
