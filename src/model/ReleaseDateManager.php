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
            p.name AS platform, 
            r.name AS region, 
            pu.name AS publisher, 
            rd.release_date AS releaseDate
            FROM release_dates AS rd
            INNER JOIN platforms AS p
            ON rd.id_platform = p.id
            INNER JOIN regions AS r
            ON rd.id_region = r.id
            INNER JOIN publishers AS pu
            ON rd.id_publisher = pu.id
            WHERE rd.id_game = 8
            ORDER BY release_date DESC');

        $req->execute(array($game_id));

        $releaseDates = [];

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

            $releaseDate = new ReleaseDate();
            $releaseDate->hydrate($data);

            $releaseDates[] = $releaseDate;

        }

        return $releaseDates;
        // $array = ['blop','blap'];
        // $releases = array_merge_recursive($releases, $array);
        // print_r($releases);die;
        // echo "<pre>";
        // print_r($releases);
        // echo "</pre>";die;

    }
 }