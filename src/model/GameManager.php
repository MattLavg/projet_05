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
     * Allows to add a game
     * 
     * @param array $values
     */
    public function addGame($values, $fileExtension)
    { 
        $req = $this->_db->prepare('INSERT INTO ' . $this->_table . ' (name, content, cover) VALUES(?, ?, )');
        $req->execute(array($values['name'], $values['content'], $fileExtension));

        $count = $req->rowCount();

        if (!empty($count)) {
            $id = $this->_db->lastInsertId();
            return $id;
        }
    }

    /**
     * Allows to update game informations
     * 
     * @param array $values
     * @param int $game_id
     */
    public function updateGame($values, $game_id)
    {
        $req = $this->_db->prepare('UPDATE games SET name = ?, content = ? WHERE id = ?');
        $req->execute(array($values['name'], $values['content'], $game_id));

        $count = $req->rowCount();

        return $count;
    }

    /**
     * Allows to add a game cover name
     * 
     * @param string $cover
     */
    public function addCover($game_id, $cover)
    { 
        $req = $this->_db->prepare('UPDATE games SET cover = ? WHERE id = ?');
        $req->execute(array($cover, $game_id));

        $count = $req->rowCount();

        return $count;
    }

    /**
     * Allows to delete a game
     * 
     * @param int $game_id
     */
    public function deleteGame($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM ' . $this->_table . ' WHERE id = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }

    /**
     * Get all games names
     * 
     * @return array $array
     */
    public function getAllNames()
    {
        $class = $this->_class;
        $req = $this->_db->query('SELECT name FROM ' . $this->_table . ' ORDER BY id DESC');

        $array = $req->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $array;
    }

 }