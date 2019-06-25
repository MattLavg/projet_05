<?php

namespace App\model;

use App\Core\Manager;
use App\model\ReleaseDate;

/**
 *  ReleaseDateManager
 * 
 *  Allows to get a release date for a game
 */

 class ReleaseDateManager extends Manager
 {
    /**
     * Allows to get the platform, region, publisher by release date for a game
     * 
     * @param int $game_id
     * @return array $releases
    */
    public function getReleases($game_id)
    {
        $req = $this->_db->prepare(
            'SELECT 
            p.id AS platformId,
            r.id AS regionId,
            pu.id AS publisherId,
            p.name AS platform, 
            r.name AS region, 
            pu.name AS publisher, 
            DATE_FORMAT(rd.release_date, \'%d/%m/%Y\') AS releaseDate
            FROM release_dates AS rd
            INNER JOIN platforms AS p
            ON rd.id_platform = p.id
            INNER JOIN regions AS r
            ON rd.id_region = r.id
            INNER JOIN publishers AS pu
            ON rd.id_publisher = pu.id
            WHERE rd.id_game = ?
            ORDER BY release_date DESC');

        $req->execute(array($game_id));

        $releaseDates = [];

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

            $releaseDate = new ReleaseDate();
            $releaseDate->hydrate($data);

            $releaseDates[] = $releaseDate;

        }

        return $releaseDates;

    }

    /**
     * Allows to add a releade date
     * 
     * @param int $game_id
     * @param array $values
     */
    public function addReleaseDate($game_id, $values)
    {
        // var_dump($game_id, $values['platform'], $values['region'], $values['publisher'], $values['date']);die;
        $req = $this->_db->prepare('INSERT INTO release_dates (id_game, id_platform, id_region, id_publisher, release_date) VALUES (?, ?, ?, ?, ?)');
        $req->execute(array($game_id, $values['platform'], $values['region'], $values['publisher'], $values['date']));
    }

    /**
     * Allows to delete a release date
     * 
     * @param int $game_id
     */
    public function deleteGameReleaseDates($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM release_dates WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }

 }