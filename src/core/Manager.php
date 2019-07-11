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

    // /**
    //  * @var string $_column
    // */
    // protected $_column = '*';

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
    public function getAll($order = null, $desc = null, $firstEntry = null, $nbElementsByPage = null, $where = null)
    {

        $sql = 'SELECT * FROM ' . $this->_table;

        // if WHERE
        if (!empty($where)) {
            $sql = $sql . $where;
        }

        // if pagination
        if (!empty($order)) {

            $sql = $sql . $order . $desc . $firstEntry .  $nbElementsByPage;

        } 
        
        // else if (!empty($order) && isset($desc) && empty($firstEntry) && empty($nbElementsByPage)) {

        //     $sql = $sql . ' ORDER BY ' . $order . ' ' . $desc;

        // } 

        // // if pagination
        // if (!empty($order)) {

        //     $sql = $sql . ' ORDER BY ' . $order . ' ' . $desc;

        // } 

        
// var_dump($order);
//         var_dump($sql);die;

        $req = $this->_db->query($sql);

        $array = [];

        if ($req) {

            while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

                $object = new $this->_class();
                $object->hydrate($data);
    
                $array[] = $object;
    
            }
        }

        return $array;
    }

    // /**
    //  * Get all the rows from a table
    //  * 
    //  * @return array $array
    //  */
    // public function getAll($order, $desc, $firstEntry = 0, $nbElementsByPage)
    // {
    //     $class = $this->_class;

    //     // if no parameters, do a simple request
    //     if ($order == null && $desc == null && $firstEntry == null && $nbElementsByPage == null) {
    //         $req = $this->_db->query('SELECT * FROM ' . $this->_table . ' ORDER BY name');

    //     // else, do a request with parameters
    //     } else {

    //         if ($desc == false) {
    //             $desc = " ";
    //         } else {
    //             $desc = ' DESC';
    //         }
    
    //         $req = $this->_db->query('SELECT * FROM ' . $this->_table . ' ORDER BY ' . $order . $desc . ' LIMIT ' . $firstEntry . ',' . $nbElementsByPage);

    //     }

    //     $array = [];

    //     if ($req) {

    //         while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

    //             $object = new $class();
    //             $object->hydrate($data);
    
    //             $array[] = $object;
    
    //         }
    //     }

    //     return $array;
    // }

    /**
     * insert name in tables developers, genres, modes, platforms, publishers and regions
     * 
     * @param array $values
     * @return int $id
     */
    public function insertEntity($values)
    {
        $req = $this->_db->prepare('INSERT INTO ' . $this->_table . ' (name) VALUES(?)');

        $req->execute(array($values['name']));

        $count = $req->rowCount();

        if (!empty($count)) {
            $id = $this->_db->lastInsertId();
            return $id;
        }
    }

    /**
     * update name in tables developers, genres, modes, platforms, publishers and regions
     * 
     * @param array $values
     */
    public function updateEntity($values)
    {
        $req = $this->_db->prepare('UPDATE ' . $this->_table . ' SET name = ? WHERE id = ?');

        $req->execute(array($values['name'], $values['id']));

        // $count = $req->rowCount();

    }

    /**
     * delete name in tables developers, genres, modes, platforms, publishers and regions
     * 
     * @param array $values
     */
    public function deleteEntity($values)
    {
        $req = $this->_db->prepare('DELETE FROM ' . $this->_table . ' WHERE id = ?');

        $req->execute(array($values['id']));

        $count = $req->rowCount();
        return $count;

    }

}
