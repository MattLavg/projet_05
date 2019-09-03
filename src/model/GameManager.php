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
    public function getGame($game_id, $updatedByMember = false)
    { 
        if (!$updatedByMember) {
            $table = 'games';
        } else {
            $table = 'update_by_member_games';
        }

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM '. $table .' WHERE id = ?');
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
     * Get searched game
     * 
     * @return array $array
     */
    public function getSearchedGame($searchedGame)
    {
        $req = $this->_db->prepare('SELECT * FROM ' . $this->_table . ' WHERE name LIKE ?');
        $req->execute(array('%'. $searchedGame . '%'));

        $array = [];

        if ($req) {

            while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

                $object = new $this->_class();
                $object->hydrate($data);
    
                $array[] = $object;
    
            }
        }

        return $array;
    }

    /**
     * Allows to count games
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM games');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to count games to validate
     * 
     * @return int $totalNbRows
     */
    public function countGamesToValidate()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM games WHERE to_validate = 1');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to count games updated by members
     * 
     * @return int $totalNbRows
     */
    public function countGamesUpdatedByMembers()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM games WHERE updated_by_member = 1');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to add a game
     * 
     * @param array $values
     */
    public function addGame($values, $fileExtension, $toValidate = null)
    { 
        $req = $this->_db->prepare('INSERT INTO ' . $this->_table . ' (name, content, cover_extension, to_validate) VALUES(?, ?, ?, ?)');
        $req->execute(array($values['name'], $values['content'], $fileExtension, $toValidate));

        $count = $req->rowCount();

        if (!empty($count)) {
            $id = $this->_db->lastInsertId();
            return $id;
        }
    }

    /**
     * Allows to add a game by a member
     * 
     * @param array $values
     */
    public function addGameByMember($values, $fileExtension)
    { 
        $req = $this->_db->prepare('INSERT INTO update_by_member_games (id, name, content, cover_extension) VALUES(?, ?, ?, ?)');
        $req->execute(array($values['id'], $values['name'], $values['content'], $fileExtension));

        $count = $req->rowCount();

        return $count;
    }

    /**
     * Allows to update game informations
     * 
     * @param array $values
     * @param int $game_id
     */
    public function updateGame($values, $fileExtension = 0, $game_id)
    {
        try {

            $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            if ($fileExtension) {
                $req = $this->_db->prepare('UPDATE games SET name = ?, content = ?, cover_extension = ? WHERE id = ?');
                $req->execute(array($values['name'], $values['content'], $fileExtension, $game_id));
            } else {
                $req = $this->_db->prepare('UPDATE games SET name = ?, content = ? WHERE id = ?');
                $req->execute(array($values['name'], $values['content'], $game_id));
            }

            $count = $req->rowCount();
            return $count;

        } catch (\PDOException $e) {

            if ($e->getCode() == 23000) {
                
                $error = $req->errorInfo();

                if ($error[1] == 1062) {

                    throw new \Exception('Vous ne pouvez enregistrer un titre de jeu qui existe déjà.');

                }
            }

            throw new \Exception('Impossible de modifier les informations du jeu');
        }
    }

    /**
     * Allows to delete a game
     * 
     * @param int $game_id
     */
    public function deleteGameAndComments($game_id)
    {
        $req = $this->_db->prepare(
        'DELETE G, C
        FROM games AS G 
        LEFT JOIN comments AS C
        ON C.id_game = G.id
        WHERE G.id = ?
        ');
        $req->execute(array($game_id));

        $count = $req->rowCount();
    }

    /**
     * Allows to delete the version of game modified by a member and waiting for validation
     * 
     * @param int $game_id
     */
    public function deleteGameUpdatedByMember($game_id)
    {
        $req = $this->_db->prepare('DELETE FROM update_by_member_games WHERE id = ?');
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
        $req = $this->_db->query('SELECT name FROM ' . $this->_table);

        $array = $req->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $array;
    }

    /**
     * Allows to validate a game
     * 
     * @param int $game_id
     */
    public function validateGame($game_id)
    {
        $req = $this->_db->prepare('UPDATE games SET to_validate = 0 WHERE id = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
        return $count;
    }

    /**
     * Allows to indicate that a game is being updated by a member and waiting for validation
     * 
     * @param int $game_id
     */
    public function updatedByMember($game_id, $updatedByMember = false)
    {
        if ($updatedByMember == false) {
            $result = 0;
        } else {
            $result = 1;
        }

        $req = $this->_db->prepare('UPDATE games SET updated_by_member = ' . $result . ' WHERE id = ?');
        $req->execute(array($game_id));

        $count = $req->rowCount();
        return $count;
    }

 }