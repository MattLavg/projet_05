<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  UpdateByMemberDeveloperManager
 * 
 *  Allows a member to add developers to a game
 */

 class UpdateByMemberDeveloperManager extends Manager
 {
    /**
     * Allows to get developers of a game updated by member
     * 
     * @param int $game_id
     * @return array $developers
    */
    public function getDevelopersUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare(
            'SELECT
            d.id,
            d.name
            FROM developers AS d
            INNER JOIN update_by_member_games_developers AS gd
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

    /**
     * Allows to ad a game developer by a member
     * 
     * @param array $game_id, $developer_id
     */
    public function addGameDeveloperByMember($game_id, $developer_id)
    {
        $req = $this->_db->prepare('INSERT INTO update_by_member_games_developers (id_game, id_developer) VALUES (?, ?)');
        $req->execute(array($game_id, $developer_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to delete a developer
     * 
     * @param int $game_id
     */
    public function deleteGameDeveloperUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM update_by_member_games_developers WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }
 }