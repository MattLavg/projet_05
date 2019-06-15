<?php 

namespace App\Controller;

use App\Model\GameManager;
use App\Model\Pagination;
use App\Core\View;
use App\Controller\ConnectionController;

/**
 * HomeController
 * 
 * Allows to show the home
 */

class HomeController
{
    /**
     * Allows to show the home
     * 
     * @param array $params optionnal
     */
    public function showHome($params = [])
    {   
        
        $gameManager = new GameManager();
        
        $games = $gameManager->getAll();

        $view = new View('home');
        $view->render('front', array(
            'games' => $games,
            'connected' => ConnectionController::isSessionValid()));

    }
}


