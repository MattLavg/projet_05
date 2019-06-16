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

 }