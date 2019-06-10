<?php

namespace App\Core;

use App\Core\Registry;

/**
 *  Manager
 * 
 *  Get the database connection
 */

abstract class Manager
{
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

}
