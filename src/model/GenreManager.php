<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  GenreManager
 * 
 *  Allows to list, count, get, add, update and delete genres
 */

 class GenreManager extends Manager
 {
    /**
     * @var string $_table
     */
    protected $_table = 'genres';

    /**
     * @var string $_class
     */
    protected $_class = 'App\Model\Genre';

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
            g.name 
            FROM genres AS g
            INNER JOIN games_genres AS gg
            ON gg.id_genre = g.id
            WHERE gg.id_game = ?');

        $req->execute(array($game_id));

        $genres = [];

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

            $genre = new Genre();
            $genre->hydrate($data);

            $genres[] = $genre;

        }

        return $genres;

    }

 }