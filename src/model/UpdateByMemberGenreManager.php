<?php

namespace App\Model;

use App\Core\Manager;

/**
 *  UpdateByMemberGenreManager
 * 
 *  Allows a member to add genres to a game
 */

 class UpdateByMemberGenreManager extends Manager
 {
    /**
     * Allows to get genres of a game updated by member
     * 
     * @param int $game_id
     * @return array $genres
     */
    public function getGenresUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare(
            'SELECT
            g.id,
            g.name 
            FROM genres AS g
            INNER JOIN update_by_member_games_genres AS gg
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
     * Allows to ad a game genre by a member
     * 
     * @param array $game_id, $genre_id
     */
    public function addGameGenreByMember($game_id, $genre_id)
    {
        $req = $this->_db->prepare('INSERT INTO update_by_member_games_genres (id_game, id_genre) VALUES (?, ?)');
        $req->execute(array($game_id, $genre_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to delete a genre
     * 
     * @param int $game_id
     */
    public function deleteGameGenresUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM update_by_member_games_genres WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }
 }