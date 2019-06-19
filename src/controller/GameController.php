<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\DeveloperManager;
use App\Model\GenreManager;
use App\Model\ModeManager;
use App\Model\ReleaseDateManager;
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

        $game_id = $id; // rename the variable for better identification

        $gameManager = new GameManager();
        $game = $gameManager->getgame($game_id);

        $developerManager = new DeveloperManager();
        $developers = $developerManager->getDevelopers($game_id);

        $genreManager = new GenreManager();
        $genres = $genreManager->getGenres($game_id);

        $modeManager = new ModeManager();
        $modes = $modeManager->getModes($game_id);

        // Get releases for a game with platforms, regions and publishers
        $releaseDateManager = new ReleaseDateManager();
        $releaseDates = $releaseDateManager->getReleases($game_id);

        $view = new View('game');
        $view->render('front', array(
            'game' => $game,
            'developers' => $developers,
            'genres' => $genres,
            'modes' => $modes,
            'releases' => $releaseDates,
            'connected' => ConnectionController::isSessionValid()));

    }

    /**
     * Allows to show the games management page
     * 
     * @param array $params optionnal
     */
    public function showGamesManagement($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            } 

            // Default action message to null
            $actionDone = null;

            // if user delete a post
            if (isset($_SESSION['actionDone'])) {
                $actionDone = $_SESSION['actionDone'];
            }

            $gameManager = new GameManager();

            // $totalNbRows = $postManager->count();
            // $url = HOST . 'post-management';

            // $pagination = new Pagination($pageNb, $totalNbRows, $url, 15);
            
            // $posts = $postManager->listPosts($pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $games = $gameManager->getAll();

            $view = new View('gameManagement');
            $view->render('back', array(
                'games' => $games,
                'isSessionValid' => ConnectionController::isSessionValid()));

            unset($_SESSION['actionDone']);

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to show the game edit page
     * 
     * @param array $params
     */
    public function showEditGame($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            // Default error message to null
            $errorMessage = null;

            // if user try to post empty fields
            if (isset($_SESSION['errorMessage'])) {
                $errorMessage = $_SESSION['errorMessage'];
            }

            if (isset($params['id'])) {

                extract($params); // Allows to extract the $id variable

                $gameManager = new GameManager();
                $post = $postManager->getgame($id);

                $view = new View('gameEdit');
                $view->render('back', array('post' => $post, 'errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            } else {

                $developerManager = new DeveloperManager();
                // $platformManager = new GenreManager();
                // $platformManager = new ModeManager();
                // $platformManager = new PublisherManager();
                // $platformManager = new PlatformManager();
                // $platformManager = new PlatformManager();
                $developers = $developerManager->getAll();

                $view = new View('gameEdit');
                $view->render('back', array(
                    'developers' => $developers,
                    'errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            }

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

 }