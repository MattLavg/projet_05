<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  RegionManager
 * 
 *  Allows to list, count, get, add, update and delete games
 */

 class RegionManager extends Manager
 {
    /**
     * @var string $_table
     */
    protected $_table = 'regions';

    /**
     * @var string $_class
     */
    protected $_class = 'App\Model\Region';

    /**
     * Allows to count regions
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM regions');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }


 }