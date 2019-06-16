<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  DeveloperManager
 * 
 *  Allows to list, count, get, add, update and delete games
 */

 class DeveloperManager extends Manager
 {
    /**
     * @var string $_table
     */
    protected $_table = 'developers';

    /**
     * @var string $_class
     */
    protected $_class = 'App\Model\Developer';

    /**
     * Allows to get developers of a game
     * 
     * @param int $game_id
     * @return array $developers
    */
    public function getDevelopers($game_id)
    {
        $req = $this->_db->prepare(
            'SELECT
            d.name 
            FROM developers AS d
            INNER JOIN games_developers AS gd
            ON gd.id_developer = d.id
            WHERE gd.id_game = ?');

        $req->execute(array($game_id));

        $developers = [];

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

            $developer = new Developer();
            $developer->hydrate($data);

            $developers[] = $developer;

        }

        return $developers;
    }
 }