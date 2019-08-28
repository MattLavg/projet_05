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
    public function getGameModes($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_modes';
        } else {
            $table = 'update_by_member_games_modes';
        }

        $req = $this->_db->prepare(
            'SELECT
            m.id,
            m.name
            FROM modes AS m
            INNER JOIN '. $table .' AS gm
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
     * Allows to count modes
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM modes');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to ad a game mode
     * 
     * @param array $game_id, $mode_id
     */
    public function addGameMode($game_id, $mode_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_modes';
        } else {
            $table = 'update_by_member_games_modes';
        }

        $req = $this->_db->prepare('INSERT INTO '. $table .' (id_game, id_mode) VALUES (?, ?)');
        $req->execute(array($game_id, $mode_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to delete a mode
     * 
     * @param int $game_id
     */
    public function deleteGameModes($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_modes';
        } else {
            $table = 'update_by_member_games_modes';
        }

        $req = $this->_db->prepare('DELETE FROM '. $table .' WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }

 }