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


 }