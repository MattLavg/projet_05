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
    public function getGameDevelopers($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_developers';
        } else {
            $table = 'update_by_member_games_developers';
        }

        $req = $this->_db->prepare(
            'SELECT
            d.id,
            d.name
            FROM developers AS d
            INNER JOIN '. $table .' AS gd
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
     * Allows to count developers
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM developers');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to ad a game developer
     * 
     * @param array $game_id, $developer_id
     */
    public function addGameDeveloper($game_id, $developer_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_developers';
        } else {
            $table = 'update_by_member_games_developers';
        }

        $req = $this->_db->prepare('INSERT INTO '. $table .' (id_game, id_developer) VALUES (?, ?)');
        $req->execute(array($game_id, $developer_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to delete a developer
     * 
     * @param int $game_id
     */
    public function deleteGameDevelopers($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_developers';
        } else {
            $table = 'update_by_member_games_developers';
        }

        $req = $this->_db->prepare('DELETE FROM '. $table .' WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }
 }