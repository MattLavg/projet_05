<?php

namespace App\Model;

use App\Model\Comment;
use App\Core\Manager;
use App\Core\MyException;

/**
 * CommentManager
 * 
 * Allows to list, count, add, update, delete, report and validate comments
 * Allows to list and count reported comments
 * Allows to check if a comment is reported
 */

class CommentManager extends Manager
{
    /**
     * Allows to list the comments
     * 
     * @param int $game_id
     * @param int $firstEntry optionnal
     * @param int $nbElementsByPage
     * 
     * @return array $comments
     */
    public function listComments($game_id, $firstEntry = 0, $nbElementsByPage)
    {
        $db = $this->_db;

        $req = $db->prepare(
            'SELECT
            com.id AS id,
            com.content AS content,
            DATE_FORMAT(com.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate,
            com.reported AS reported,
            mem.id AS memberId,
            mem.nick_name AS memberNickName,
            games.id AS gameId
            FROM comments AS com
            INNER JOIN members AS mem
            ON com.id_member = mem.id
            INNER JOIN games AS games
            ON com.id_game = games.id
            WHERE com.id_game = ?
            ORDER BY com.creation_date
            DESC LIMIT ' . $firstEntry . ',' . $nbElementsByPage
        );

        $req->execute(array($game_id));

        $comments = [];

        if ($req) {

            while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

                $comment = new Comment();
                $comment->hydrate($data);
    
                $comments[] = $comment;
            }
        }
        
        return $comments;
    }

    /**
     * Allows to count comments of a post
     * 
     * @param int $post_id
     * 
     * @return int $totalNbRows
     */
    public function count($game_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS nbRows FROM comments WHERE game_id = ?');
        $req->execute(array($game_id));
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to count the reported comments
     * 
     * @return int $result['nbReportedComments']
     */
    public function countReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) nbReportedComments FROM comments WHERE reported = 1');

        $result = $req->fetch();

        return $result['nbReportedComments'];
    }

    /**
     * Allows to list the reported comments
     * 
     * @param int $firstEntry optionnal
     * @param int $nbElementsByPage
     * 
     * @return array $comments
     */
    public function listReportedComments($firstEntry = 0, $nbElementsByPage)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, author, content, reported, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate FROM comments WHERE reported = 1 ORDER BY comments.creationDate DESC LIMIT ' . $firstEntry . ',' . $nbElementsByPage);

        $comments = [];

        if ($req) {

            while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
  
                $comment = new Comment();
                $comment->hydrate($data);
    
                $comments[] = $comment; 
            }
        } 

        return $comments;
    }

    /**
     * Allows to add a comment
     * 
     * @param array $values
     * @param bool $admin optionnal
     * 
     * @return int the last insert id
     */
    public function addComment($values)
    {
        // echo "<pre>";
        // print_r($values);
        // echo "</pre>";die;

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (id_member, id_game, content, creation_date) VALUES(?, ?, ?, NOW())');

        $req->execute(array($values['member_id'], $values['game_id'], $values['content']));

        $count = $req->rowCount();
        
        if (!$count) {
            throw new MyException('Impossible d\'ajouter le commentaire');
        }

        return $db->lastInsertId();
    }

    /**
     * Allows to delete a comment
     * 
     * @param int $id
     */
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));

        $count = $req->rowCount();

        if (!$count) {
            throw new MyException('Impossible de supprimer le commentaire');
        }
    }

    /**
     * Allows to report a comment
     * 
     * @param int $id
     * 
     * @return bool $reportedComment
     */
    public function reportComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $reportedComment = $req->execute(array($id));

        $count = $req->rowCount();

        if (!$count) {
            throw new MyException('Impossible de signaler le commentaire');
        }

        return $reportedComment;
    }

    /**
     * Allows to validate a comment
     * 
     * @param int $id
     */
    public function validComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');
        $req->execute(array($id));

        $count = $req->rowCount();

        if (!$count) {
            throw new MyException('Impossible de valider le commentaire');
        }
    }

    /**
     * Allows to check if a comment is reported
     * 
     * @param int $id
     * 
     * @return array $data
     */
    public function isReportedComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT reported FROM comments WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }
}