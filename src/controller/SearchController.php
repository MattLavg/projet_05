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
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;

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

        $searchedGameExploded = explode(" ", $params['game']);

        $gameManager = new GameManager();
        $games = $gameManager->getAll();

        $foundGames = [];

        // $result = stripos(strtolower('mario kart 8'), strtolower('mario'));
        // var_dump($result);die;

        foreach ($games as $game) {

            if (strtolower($params['game']) == strtolower($game->getName())) {

                $view = new View();
                $view->redirect('game/id/' . $game->getId()); 

            } 
            // else {
            //     foreach ($searchedGameExploded as $searchedGamePart) {
            //         // var_dump($searchedGamePart);
            //         if (stripos(strtolower($game->getName()), strtolower($searchedGamePart)) != false) {
            //             $foundGames [] = $game;
            //         }
            //     }

                
            // }
            var_dump(stripos(strtolower($game->getName()), strtolower($params['game'])));
            if (stripos(strtolower($game->getName()), strtolower($params['game'])) != false) {
                $foundGames [] = $game;
            }
        }var_dump($foundGames);die;

        // foreach ($games as $key => $value) {
        //     var_dump($games);
        // }die;

    // echo "<pre>";
    // print_r($games);
    // echo "</pre>";die;
// var_dump($result);die;
            if ($result) {

                $view = new View('search');
                $view->render('front', array(
                    'member' => $currentMember
                ));

            } else {
                $_SESSION['errorMessage'] = 'La recherche n\'a donné aucun résultat.';

                $view = new View();
                $view->redirect('home');
            }
    }

 }