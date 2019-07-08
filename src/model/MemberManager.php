<?php

namespace App\Model;

use App\Core\Manager;
use App\Model\Member;

/**
 *  MemberManager
 * 
 *  Allows to ......
 */

 class MemberManager extends Manager
 {
    /**
     * @var string $_table
     */
    protected $_table = 'members';

    /**
     * Allows to get a member
     */
    public function getMember($member_mail)
    {
        $req = $this->_db->prepare('SELECT * FROM ' . $this->_table . ' WHERE mail = ?');
        $req->execute(array($member_mail));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $member = new Member();
        $member->hydrate($data);

        return $member;

    }

    /**
     * Allows to update the last connection date
     */
    public function updateLastConnectionDate($member_id)
    {
        $req = $this->_db->prepare('UPDATE ' . $this->_table . ' SET last_connection_date = NOW() WHERE id = ?');
        $req->execute(array($member_id));

        // $count = $req->rowCount();
    }

    /**
     * Allows to get all members nicknames
     */
    public function getAllNickNames()
    {
        $req = $this->_db->query('SELECT nick_name FROM ' . $this->_table);

        $array = $req->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $array;
    }

    /**
     * Allows to get all members emails
     */
    public function getAllMails()
    {
        $req = $this->_db->query('SELECT mail FROM ' . $this->_table);

        $array = $req->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $array;
    }

    /**
     * Allows to add a member
     * 
     * @param array $values
     */
//     public function addMember($values, $cryptedPassword)
//     {
//         $req = $this->_db->prepare('INSERT INTO ' . $this->_table . ' (nick_name, mail, inscription_date, password, id_type) VALUES(?, ?, NOW(), ?, ?)');
//         $req->execute(array(
//             $values['nickName'],
//             $values['mail'],
//             $cryptedPassword,
//             3
//         ));

//         $count = $req->rowCount();

// var_dump($this->_db->lastInsertId());die;
//         if (!empty($count)) {
//             $id = $this->_db->lastInsertId();
//             return $id;
//         }
//     }

    /**
     * Allows to add a member
     * 
     * @param array $values
     */
    public function addMember($values, $cryptedPassword)
    {
        // $req = $this->_db->prepare('INSERT INTO ' . $this->_table . ' (nick_name, mail, inscription_date, password, id_type) VALUES(?, ?, NOW(), ?, ?)');
        // $req->execute(array(
        //     $values['nickName'],
        //     $values['mail'],
        //     $values['password'],
        //     3
        // ));
        // $id = $this->_db->lastInsertId();
        // var_dump($id);die;
//         $count = $req->rowCount();

// var_dump($this->_db->lastInsertId());die;
//         if (!empty($count)) {
//             $id = $this->_db->lastInsertId();
//             return $id;
//         }


        try {

            $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $req = $this->_db->prepare('INSERT INTO ' . $this->_table . ' (nick_name, mail, inscription_date, last_connection_date, password, id_type) VALUES(?, ?, NOW(), NOW(), ?, ?)');
            $req->execute(array(
                $values['nickName'],
                $values['mail'],
                $cryptedPassword,
                3
            ));

            $count = $req->rowCount();

            if (!empty($count)) {
                $id = $this->_db->lastInsertId();
                return $id;
            }

        } catch (\PDOException $e) {

            throw new \Exception($e->getMessage());
        }

    }
 }