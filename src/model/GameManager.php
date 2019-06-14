<?php

namespace App\Model;

use App\Core\Manager;
use App\Model\Game;

/**
 *  GameManager
 * 
 *  Allows to list, count, get, add, update and delete games
 */

 class GameManager extends Manager
 {
    /**
     * @var string $_table
    */
    protected $_table = 'games';

    /**
     * @var string $_class
    */
    protected $_class = 'App\Model\Game';


    /**
     * Allows to get a game
     * 
     * @param int $id
     * @return object PDOStatement
     */
    public function getGame($game_id)
    { 
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM games WHERE id = ?');
        $req->execute(array($game_id));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        // if (!$data) {
        //     throw new MyException('Impossible d\'afficher l\'article');
        // }

        $game = new Game();
        $game->hydrate($data);

        return $game;
    }

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
            d.name AS developer_name
            FROM developers AS d
            INNER JOIN games_developers AS gd
            ON gd.id_developer = d.id
            WHERE gd.id_game = ?');

        $req->execute(array($game_id));

        $developers = $req->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $developers;

    }

    /**
     * Allows to get genres of a game
     * 
     * @param int $game_id
     * @return array $genres
    */
    public function getGenres($game_id)
    {
        $req = $this->_db->prepare(
            'SELECT
            g.name AS genre_name
            FROM genres AS g
            INNER JOIN games_genres AS gg
            ON gg.id_genre = g.id
            WHERE gg.id_game = ?');

        $req->execute(array($game_id));

        $genres = $req->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $genres;

    }

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
            m.name AS mode_name
            FROM modes AS m
            INNER JOIN games_modes AS gm
            ON gm.id_mode = m.id
            WHERE gm.id_game = ?');

        $req->execute(array($game_id));

        $modes = $req->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $modes;

    }

 }