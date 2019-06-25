<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\DeveloperManager;
use App\Model\GenreManager;
use App\Model\ModeManager;
use App\Model\PlatformManager;
use App\Model\PublisherManager;
use App\Model\RegionManager;
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
        $game = $gameManager->getGame($game_id);

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

                $game_id = $id;

                // get the game
                $gameManager = new GameManager();
                $game = $gameManager->getGame($game_id);

                // get the game developers and all developers for list
                $developerManager = new DeveloperManager();
                $developers = $developerManager->getDevelopers($game_id);
                $allDevelopers = $developerManager->getAll();

                $genreManager = new GenreManager();
                $genres = $genreManager->getGenres($game_id);
                $allGenres = $genreManager->getAll();

                $modeManager = new ModeManager();
                $modes = $modeManager->getModes($game_id);
                $allModes = $modeManager->getAll();

                $platformManager = new PlatformManager();
                $allPlatforms = $platformManager->getAll();

                $publisherManager = new PublisherManager();
                $allPublishers = $publisherManager->getAll();

                $regionManager = new RegionManager();
                $allRegions = $regionManager->getAll();

                $releaseDateManager = new ReleaseDateManager();
                $releaseDates = $releaseDateManager->getReleases($game_id);

                // echo "<pre>";
                // print_r($releaseDates);
                // echo "</pre>";die;

                $view = new View('gameEdit');
                $view->render('back', array(
                    'game_id' => $game_id,
                    'game' => $game, 
                    'developers' => $developers,
                    'genres' => $genres,
                    'modes' => $modes,
                    'releaseDates' => $releaseDates,
                    'allDevelopers' => $allDevelopers,
                    'allGenres' => $allGenres,
                    'allModes' => $allModes,
                    'allPlatforms' => $allPlatforms,
                    'allPublishers' => $allPublishers,
                    'allRegions' => $allRegions,
                    'errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            } else {

                $developerManager = new DeveloperManager();
                $genreManager = new GenreManager();
                $modeManager = new ModeManager();
                $platformManager = new PlatformManager();
                $publisherManager = new PublisherManager();
                $regionManager = new RegionManager();

                $developers = $developerManager->getAll();
                $genres = $genreManager->getAll();
                $modes = $modeManager->getAll();
                $platforms = $platformManager->getAll();
                $publishers = $publisherManager->getAll();
                $regions = $regionManager->getAll();

                $view = new View('gameEdit');
                $view->render('back', array(
                    'developers' => $developers,
                    'genres' => $genres,
                    'modes' => $modes,
                    'platforms' => $platforms,
                    'publishers' => $publishers,
                    'regions' => $regions,
                    'errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            }

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to add a game
     * 
     * @param array $params
     */
    public function addGame($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;
        $params['name'] = trim(strip_tags($params['name']));

        if (ConnectionController::isSessionValid()) {

            // Add game informations
            $gameManager = new GameManager();
            $game_id = $gameManager->addGame($params);

            // Add games developers
            $developerManager = new DeveloperManager();
            foreach($params['developer'] as $developer_id) {

                $developerManager->addGameDeveloper($game_id, $developer_id);
            }

            // Add games genres
            $genreManager = new GenreManager();
            foreach($params['genre'] as $genre_id) {

                $genreManager->addGameGenre($game_id, $genre_id);
            }

            // Add games modes
            $modeManager = new ModeManager();
            foreach($params['mode'] as $mode_id) {
                
                $modeManager->addGameMode($game_id, $mode_id);
            }

            // Add games release
            $releaseDateManager = new ReleaseDateManager();
            foreach($params['releaseDate'] as $releaseDate_array) {
                
                $releaseDateManager->addReleaseDate($game_id, $releaseDate_array);
            }

            $view = new View();
            $view->redirect('home');

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to update a game
     * 
     * @param array $params
     */
    public function updateGame($params = [])
    {
        echo "<pre>";
        print_r($params);
        echo "</pre>";die;
        if (ConnectionController::isSessionValid()) {

            // Delete game developers
            $developerManager = new DeveloperManager();
            $developerManager->deleteGameDevelopers($params['id']);

            // Delete games genres
            $genreManager = new GenreManager();
            $genreManager->deleteGameGenres($params['id']);

            // Delete games modes
            $modeManager = new ModeManager();
            $modeManager->deleteGameModes($params['id']);

            // Delete games release
            $releaseDateManager = new ReleaseDateManager();
            $releaseDateManager->deleteGameReleaseDates($params['id']);

            // Delete game informations
            $gameManager = new GameManager();
            $gameManager->deleteGame($params['id']);

            $view = new View();
            $view->redirect('home');

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to delete a game
     * 
     * @param array $params
     */
    public function deleteGame($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            // Delete game developers
            $developerManager = new DeveloperManager();
            $developerManager->deleteGameDevelopers($params['id']);

            // Delete games genres
            $genreManager = new GenreManager();
            $genreManager->deleteGameGenres($params['id']);

            // Delete games modes
            $modeManager = new ModeManager();
            $modeManager->deleteGameModes($params['id']);

            // Delete games release
            $releaseDateManager = new ReleaseDateManager();
            $releaseDateManager->deleteGameReleaseDates($params['id']);

            // Delete game informations
            $gameManager = new GameManager();
            $gameManager->deleteGame($params['id']);

            $view = new View();
            $view->redirect('home');

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

 }