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
    public function getGameGenres($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_genres';
        } else {
            $table = 'update_by_member_games_genres';
        }

        $req = $this->_db->prepare(
            'SELECT
            g.id,
            g.name 
            FROM genres AS g
            INNER JOIN '. $table .' AS gg
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

    /**
     * Allows to count genres
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM genres');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to ad a game genre
     * 
     * @param array $game_id, $genre_id
     */
    public function addGameGenre($game_id, $genre_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_genres';
        } else {
            $table = 'update_by_member_games_genres';
        }

        $req = $this->_db->prepare('INSERT INTO '. $table .' (id_game, id_genre) VALUES (?, ?)');
        $req->execute(array($game_id, $genre_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to delete a genre
     * 
     * @param int $game_id
     */
    public function deleteGameGenres($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'games_genres';
        } else {
            $table = 'update_by_member_games_genres';
        }

        $req = $this->_db->prepare('DELETE FROM '. $table .' WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }

 }