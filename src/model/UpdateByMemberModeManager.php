<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  UpdateByMemberModeManager
 * 
 *  Allows a member to add genres to a game
 */

 class UpdateByMemberModeManager extends Manager
 {
    /**
     * Allows to get modes of a game updated by member
     * 
     * @param int $game_id
     * @return array $modes
     */
    public function getModesUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare(
            'SELECT
            m.id,
            m.name
            FROM modes AS m
            INNER JOIN update_by_member_games_modes AS gm
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
    public function addGameModeByMember($game_id, $mode_id)
    {
        $req = $this->_db->prepare('INSERT INTO update_by_member_games_modes (id_game, id_mode) VALUES (?, ?)');
        $req->execute(array($game_id, $mode_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to delete a mode
     * 
     * @param int $game_id
     */
    public function deleteGameModesUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM update_by_member_games_modes WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }
 }