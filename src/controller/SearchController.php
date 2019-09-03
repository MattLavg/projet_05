<?php

namespace App\Controller;

use App\Core\View;
use App\Model\GameManager;

/**
 * SearchController
 * 
 * Allows to search a game
 */

 class SearchController
 {
    /**
     * Allows to search for a game
     * 
     * @param 
     */
    public function searchGame($params = [])
    {
        $currentMember = null;

        if (isset($_SESSION['currentMember'])) {
            $currentMember = $_SESSION['currentMember'];
        }

        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        }
        
        $params['game'] = trim(strip_tags($params['game']));

        if (empty($params['game'])) {
            $_SESSION['errorMessage'] = 'Vous devez remplir le champ pour lancer la recherche.';

            $view = new View();
            $view->redirect('home');
        }

        $gameManager = new GameManager();
        $foundGames = $gameManager->getSearchedGame($params['game']);
        
        if (!empty($foundGames)) {

            $view = new View('search');
            $view->render('front', array(
                'games' => $foundGames,
                'searchedGame' => $params['game'],
                'member' => $currentMember
            ));

        } else {

            $view = new View('search');
            $view->render('front', array(
                'searchedGame' => $params['game'],
                'member' => $currentMember
            ));
        }
    }

 }