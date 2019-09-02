<?php

namespace App\model;

use App\Core\Manager;
use App\Core\View;
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
    public function getGameReleases($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'release_dates';
        } else {
            $table = 'update_by_member_release_dates';
        }

        $req = $this->_db->prepare(
            'SELECT 
            p.id AS platformId,
            r.id AS regionId,
            pu.id AS publisherId,
            p.name AS platform, 
            r.name AS region, 
            pu.name AS publisher, 
            DATE_FORMAT(rd.release_date, \'%d/%m/%Y\') AS releaseDate
            FROM '. $table .' AS rd
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
     * Allows to count releases
     * 
     * @return int $totalNbRows
     */
    public function count($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'release_dates';
        } else {
            $table = 'update_by_member_release_dates';
        }

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS nbRows FROM '. $table .' WHERE id_game = ?');
        $req->execute(array($game_id));
        
        $result = $req->fetch();
  
        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to add a releade date
     * 
     * @param int $game_id
     * @param array $values
     */
    public function addGameReleaseDate($game_id, $values, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'release_dates';
        } else {
            $table = 'update_by_member_release_dates';
        }

        try {

            $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $req = $this->_db->prepare('INSERT INTO '. $table .' (id_game, id_platform, id_region, id_publisher, release_date) VALUES (?, ?, ?, ?, ?)');
            $result = $req->execute(array($game_id, $values['platform'], $values['region'], $values['publisher'], $values['date']));

            $count = $req->rowCount();
            return $count;

        } catch (\PDOException $e) {

            if ($e->getCode() == 23000) {
                
                $error = $req->errorInfo();

                if ($error[1] == 1062) {

                    throw new \Exception('Vous ne pouvez enregistrer deux fois la même date avec les mêmes informations pour un jeu.');

                }
            }

            throw new \Exception('Impossible d\'enregistrer la ou les dates de sortie.');
        }



    }

    /**
     * Allows to delete a release date
     * 
     * @param int $game_id
     */
    public function deleteGameReleaseDates($game_id, $updatedByMember = false)
    {
        if (!$updatedByMember) {
            $table = 'release_dates';
        } else {
            $table = 'update_by_member_release_dates';
        }

        $req = $this->_db->prepare('DELETE FROM '. $table .' WHERE id_game = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }

 }