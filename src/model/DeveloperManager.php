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
            d.id,
            d.name,
            gd.id 
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

    /**
     * Allows to ad a game developer
     * 
     * @param array $game_id, $developer_id
     */
    public function addGameDeveloper($game_id, $developer_id)
    {
        $req = $this->_db->prepare('INSERT INTO games_developers (id_game, id_developer) VALUES (?, ?)');
        $req->execute(array($game_id, $developer_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to update game developers informations
     * 
     * @param int $game_id
     * @param int $developer_id
     */
    // public function updateGameDeveloper($game_id, $developer_id)
    // {
    //     $req = $this->_db->prepare('UPDATE games_developers SET ')
    // }

    /**
     * Allows to delete a developer
     * 
     * @param int $game_id
     */
    public function deleteGameDevelopers($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM games_developers WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }
 }