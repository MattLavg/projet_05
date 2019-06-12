<?php

namespace App\Controller;

use App\Model\GameManager;
// use App\Model\CommentManager;
// use App\Model\Pagination;
// use App\Controller\ConnectionController;
use App\Core\View;

/**
 *  GameController
 * 
 *  Allows to show, add, update and delete games with linked comments
 */

 class GameController
 {
     /**
     *  Allows to show post
     * 
     *  @param array $params optionnal 
     */
    public function showGame($params = [])
    {
        extract($params); // Allows to extract the $id variable

        $gameId = $id; // rename the variable for better identification

        $gameManager = new GameManager();
        $game = $gameManager->getgame($gameId);

        $view = new View('game');
        $view->render('front', array(
            'game' => $game));

    }
 }