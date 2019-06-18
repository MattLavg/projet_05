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


 }