<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  UpdateByMemberGameManager
 * 
 *  Allows a member to add or update games 
 */

 class UpdateByMemberGameManager extends Manager
 {
    /**
     * Allows to get a game updated by member
     * 
     * @param int $id
     * @return object PDOStatement
     */
    public function getGameUpdatedByMember($game_id)
    { 
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM update_by_member_games WHERE id = ?');
        $req->execute(array($game_id));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $game = new Game();
        $game->hydrate($data);

        return $game;
    }

    /**
     * Allows to add a game by a member
     * 
     * @param array $values
     */
    public function addGameByMember($values, $fileExtension)
    { 
        $req = $this->_db->prepare('INSERT INTO update_by_member_games (id, name, content, cover_extension) VALUES(?, ?, ?, ?)');
        $req->execute(array($values['id'], $values['name'], $values['content'], $fileExtension));

        $count = $req->rowCount();

        return $count;
    }

    /**
     * Allows to delete the version of game modified by a member and waiting for validation
     * 
     * @param int $game_id
     */
    public function deleteGameUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM update_by_member_games WHERE id = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }
 }