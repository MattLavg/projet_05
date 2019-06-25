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
            m.id,
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

    /**
     * Allows to ad a game mode
     * 
     * @param array $game_id, $mode_id
     */
    public function addGameMode($game_id, $mode_id)
    {
        $req = $this->_db->prepare('INSERT INTO games_modes (id_game, id_mode) VALUES (?, ?)');
        $req->execute(array($game_id, $mode_id));
    }

    /**
     * Allows to delete a mode
     * 
     * @param int $game_id
     */
    public function deleteGameModes($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM games_modes WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }

 }