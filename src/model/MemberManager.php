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
 }