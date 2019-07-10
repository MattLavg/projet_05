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
     * @var string $_class
     */
    protected $_class = 'App\Model\Member';

    /**
     * Allows to get a member
     * 
     * @param string $value
     */
    public function getMemberById($value)
    {
        $req = $this->_db->prepare('SELECT id, first_name, last_name, nick_name, mail, DATE_FORMAT(inscription_date, \'%d/%m/%Y à %Hh%imin%ss\') AS inscription_date, DATE_FORMAT(last_connection_date, \'%d/%m/%Y à %Hh%imin%ss\') AS last_connection_date, password, id_type, DATE_FORMAT(birthday, \'%d/%m/%Y\') AS birthday FROM ' . $this->_table . ' WHERE id = ?');
        $req->execute(array($value));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $member = new Member();
        $member->hydrate($data);

        return $member;

    }

    /**
     * Allows to get a member
     * 
     * @param string $value
     */
    public function getMemberByMail($value)
    {
        $req = $this->_db->prepare('SELECT id, first_name, last_name, nick_name, mail, DATE_FORMAT(inscription_date, \'%d/%m/%Y à %Hh%imin%ss\') AS inscription_date, DATE_FORMAT(last_connection_date, \'%d/%m/%Y à %Hh%imin%ss\') AS last_connection_date, password, id_type, DATE_FORMAT(birthday, \'%d/%m/%Y\') AS birthday FROM ' . $this->_table . ' WHERE mail = ?');
        $req->execute(array($value));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $member = new Member();
        $member->hydrate($data);

        return $member;

    }

    /**
     * Get all the members from a table
     * 
     * @return array $array
     */
    public function getAllMembers($order, $desc, $firstEntry = 0, $nbElementsByPage, $displayedMembers)
    {
        $class = $this->_class;

        if ($displayedMembers == 'members') {
            $req = $this->_db->query('SELECT * FROM ' . $this->_table . ' WHERE id_type = 3 ORDER BY ' . $order . $desc . ' LIMIT ' . $firstEntry . ',' . $nbElementsByPage);
        } else if ($displayedMembers == 'moderators') {
            $req = $this->_db->query('SELECT * FROM ' . $this->_table . ' WHERE id_type = 2 ORDER BY ' . $order . $desc . ' LIMIT ' . $firstEntry . ',' . $nbElementsByPage);
        } else {
            $req = $this->_db->query('SELECT * FROM ' . $this->_table . ' WHERE id_type = 3 OR id_type = 2 ORDER BY ' . $order . $desc . ' LIMIT ' . $firstEntry . ',' . $nbElementsByPage);
        }

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

    /**
     * Allows to count member without the Admin
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM members WHERE NOT id_type = 1');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
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

        // try {

        //     $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //     $req = $this->_db->prepare('INSERT INTO ' . $this->_table . ' (nick_name, mail, inscription_date, last_connection_date, password, id_type) VALUES(?, ?, NOW(), NOW(), ?, ?)');
        //     $req->execute(array(
        //         $values['nickName'],
        //         $values['mail'],
        //         $cryptedPassword,
        //         3
        //     ));

        //     $count = $req->rowCount();

        //     if (!empty($count)) {
        //         $id = $this->_db->lastInsertId();
        //         return $id;
        //     }

        // } catch (\PDOException $e) {

        //     throw new \Exception($e->getMessage());
        // }

    }

    /**
     * Allows to update members informations
     * 
     * @param array $values
     */
    public function updateInfosMember($values)
    {
        try {

            $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $req = $this->_db->prepare('UPDATE members SET 
            first_name = ?,
            last_name = ?,
            nick_name = ?,
            mail = ?,
            birthday = ?
            WHERE id = ?');
            $req->execute(array(
                $values['firstName'], 
                $values['lastName'], 
                $values['nickName'],
                $values['mail'],
                $values['birthday'],
                $values['member_id'],));
  
            $count = $req->rowCount();
            return $count;

        } catch (\PDOException $e) {

            if ($e->getCode() == 23000) {
                
                $error = $req->errorInfo();

                if ($error[1] == 1062) {

                    throw new \Exception('Vous ne pouvez enregistrer un pseudo ou un mail qui existe déjà.');

                }
            }

            throw new \Exception('Impossible de modifier les informations du membre');
        }
    }

    /**
     * Allows to update members password
     * 
     * @param array $values
     * @param string $cryptedPassword
     */
    public function updatePasswordMember($values, $cryptedPassword)
    {
        $req = $this->_db->prepare('UPDATE members SET password = ? WHERE id = ?');
        $req->execute(array($cryptedPassword, $values['member_id']));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to update members status
     * 
     * @param array $status
     */
    public function updateStatusMember($member_id, $status)
    {
        $req = $this->_db->prepare('UPDATE members SET id_type = ? WHERE id = ?');
        $req->execute(array($status, $member_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to delete a member
     * 
     * @param string $member_id
     */
    public function deleteMember($member_id)
    {
        $req = $this->_db->prepare('DELETE FROM members WHERE id = ?');
        $req->execute(array($member_id));

        $count = $req->rowCount();
        return $count;
    }
 }