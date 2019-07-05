<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  PublisherManager
 * 
 *  Allows to list, count, get, add, update and delete games
 */

 class PublisherManager extends Manager
 {
    /**
     * @var string $_table
     */
    protected $_table = 'publishers';

    /**
     * @var string $_class
     */
    protected $_class = 'App\Model\Publisher';

    /**
     * Allows to count publishers
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM publishers');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }


 }