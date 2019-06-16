<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  ModeManager
 * 
 *  Allows to list, count, get, add, update and delete genres
 */

 class ModeManager extends Manager
 {
    /**
     * @var string $_table
     */
    protected $_table = 'modes';

    /**
     * @var string $_class
     */
    protected $_class = 'App\Model\Mode';

    /**
     * Allows to get modes of a game
     * 
     * @param int $game_id
     * @return array $modes
     */
    public function getModes($game_id)
    {
        $req = $this->_db->prepare(
            'SELECT
            m.name
            FROM modes AS m
            INNER JOIN games_modes AS gm
            ON gm.id_mode = m.id
            WHERE gm.id_game = ?');

        $req->execute(array($game_id));

        $modes = [];

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

            $mode = new Mode();
            $mode->hydrate($data);

            $modes[] = $mode;

        }

        return $modes;

    }

 }