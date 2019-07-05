<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  PlatformManager
 * 
 *  Allows to list, count, get, add, update and delete platforms
 */

 class PlatformManager extends Manager
 {
    /**
     * @var string $_table
     */
    protected $_table = 'platforms';

    /**
     * @var string $_class
     */
    protected $_class = 'App\Model\Platform';

    /**
     * Allows to count platforms
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM platforms');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }


 }