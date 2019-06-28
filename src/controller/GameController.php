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
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;
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
        echo "<pre>";
        print_r($params);
        echo "</pre>";

        if (ConnectionController::isSessionValid()) {

            // Allows to use a function on each element of multidimensionnal array
            // Variable must be passed by reference to be modified by the function
            array_walk_recursive($params, function(&$item, $key) {

                if ($key != 'content') {

                    $item = trim(strip_tags($item));

                } elseif ($key == '0') {

                    $item = trim(strip_tags($item));

                }

                if(empty($item)) {
          
                    $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs.';

                    $view = new View();
                    $view->redirect('edit-game');
                }
            });

            $gameManager = new GameManager();
            $games = $gameManager->getAllNames();

            // Check if game already exists
            $result = array_search($params['name'], $games);

            if ($result) {
                
                $_SESSION['errorMessage'] = 'Le jeu existe déjà.';

                $view = new View();
                $view->redirect('edit-game');

            }

            // Allows to delete duplicated developers
            $params['developer'] = array_unique($params['developer']);

            // Check if array developer contains integers as expected
            // return array with successfull values
            $filterDeveloperArray = filter_var_array($params['developer'], FILTER_VALIDATE_INT);

            // Check if somes values are false or null
            foreach ($filterDeveloperArray as $key => $value) {
                if (empty($value) || $value == false) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour développeur, non valide.';

                    $view = new View();
                    $view->redirect('edit-game');
                }
            }

            // Allows to delete duplicated genres
            $params['genre'] = array_unique($params['genre']);

            // Check if array developer contains integers as expected
            // return array with successfull values
            $filterGenreArray = filter_var_array($params['genre'], FILTER_VALIDATE_INT);

            // Check if somes values are false or null
            foreach ($filterGenreArray as $key => $value) {
                if (empty($value) || $value == false) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour genre, non valide.';

                    $view = new View();
                    $view->redirect('edit-game');
                }
            }

            // Allows to delete duplicates modes
            $params['mode'] = array_unique($params['mode']);

            // Check if array developer contains integers as expected
            // return array with successfull values
            $filterModeArray = filter_var_array($params['mode'], FILTER_VALIDATE_INT);

            // Check if somes values are false or null
            foreach ($filterModeArray as $key => $value) {
                if (empty($value) || $value == false) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour mode, non valide.';

                    $view = new View();
                    $view->redirect('edit-game');
                }
            }

            
            echo "<pre>";
            print_r($params);
            echo "</pre>";

            die;

            // Check if game name is valid
            if (isset($params['name']) && !empty($params['name'])) {

                // delete tags and spaces at the beginning and the end
                $params['name'] = trim(strip_tags($params['name']));

                // check if not empty again
                if(empty($params['name'])) {
    
                    $_SESSION['errorMessage'] = 'Champ vide, vous devez renseigner le titre du jeu.';
    
                    $view = new View();
                    $view->redirect('edit-game');
                }

                $gameManager = new GameManager();
                $games = $gameManager->getAllNames();

                $result = array_search($params['name'], $games);

                // if true, game already exists
                if ($result) {
                    
                    $_SESSION['errorMessage'] = 'Le jeu existe déjà.';
    
                    $view = new View();
                    $view->redirect('edit-game');

                }
            
            } else  {
    
                $_SESSION['errorMessage'] = 'Vous devez renseigner le titre du jeu.';
    
                $view = new View();
                $view->redirect('edit-game');
            }
    
            // Check if game content is valid
            if (isset($params['content']) && empty($params['content'])) {
    
                $_SESSION['errorMessage'] = 'Vous devez renseigner la description du jeu.';
    
                $view = new View();
                $view->redirect('edit-game');
            }
            

            // Check if game developer is a valid array
            $params['developer'] = array_filter($params['developer']);

            if ($params['developer']) {
                
                // Allows to delete duplicated developers
                $params['developer'] = array_unique($params['developer']);
         
                // Check if array contains integers as expected
                $filterArray = filter_var_array($params['developer'], FILTER_VALIDATE_INT);
                // var_dump($filterArray);die;
                foreach ($filterArray as $key => $value) {
                    if ($value == false) {

                        $_SESSION['errorMessage'] = 'Valeur reçue non valide.';
    
                        $view = new View();
                        $view->redirect('edit-game');
                    }
                }

          
                // if (!$filterArray || empty($filterArray)) {

                //     $_SESSION['errorMessage'] = 'La valeur reçue n\'est pas valide pour un développeur.';
    
                //     $view = new View();
                //     $view->redirect('edit-game');
                // }

                // Allows to use a function on each element of multidimensionnal array
                array_walk_recursive($params['developer'], function($item, $key) {
    
                    // $item = value
                    $item = trim(strip_tags($item));
        
                    if(empty($item)) {
              
                        $_SESSION['errorMessage'] = 'Un nom de développeur n\'est pas valide.';
    
                        $view = new View();
                        $view->redirect('edit-game');
                    }
                });
                
    
            } else {
     
                $_SESSION['errorMessage'] = 'Vous devez renseigner un développeur pour le jeu.';
    
                $view = new View();
                $view->redirect('edit-game');
            }
    
            // Check if game genre is valid
            if (isset($params['genre']) && !empty($params['genre'])) {

                // Allows to delete duplicates genres
                $params['genre'] = array_unique($params['genre']);
    
                array_walk_recursive($params['genre'], function($item, $key) {
    
                    $item = trim(strip_tags($item));
        
                    if(empty($item) || $item == 'Choisissez un genre') {
              
                        $_SESSION['errorMessage'] = 'Un nom de genre n\'est pas valide.';
    
                        $view = new View();
                        $view->redirect('edit-game');
                    }
                });
    
            } else {
     
                $_SESSION['errorMessage'] = 'Vous devez renseigner un genre pour le jeu.';
    
                $view = new View();
                $view->redirect('edit-game');
            }
    
            // Check if game mode is valid
            if (isset($params['mode']) && !empty($params['mode'])) {

                // Allows to delete duplicates modes
                $params['mode'] = array_unique($params['mode']);
    
                array_walk_recursive($params['mode'], function($item, $key) {
    
                    $item = trim(strip_tags($item));
        
                    if(empty($item) || $item == 'Choisissez un mode') {
              
                        $_SESSION['errorMessage'] = 'Un nom de mode n\'est pas valide.';
    
                        $view = new View();
                        $view->redirect('edit-game');
                    }
                });
    
            } else {
     
                $_SESSION['errorMessage'] = 'Vous devez renseigner un mode pour le jeu.';
    
                $view = new View();
                $view->redirect('edit-game');
            }
            
            // Check is release date is valid
            // if (isset($params['releaseDate']) && !empty($params['releaseDate'])) {
    
            //     array_walk_recursive($params['releaseDate'], function($item, $key) {
    
            //         $item = trim(strip_tags($item));
    
            //         if(empty($item) || $item == 'Choisissez un support' || $item == 'Choisissez un éditeur' || $item == 'Choisissez une région') {
              
            //             $_SESSION['errorMessage'] = 'Un des champs d\'une date n\'est pas valide.';
    
            //             $view = new View();
            //             $view->redirect('edit-game');
            //         }
            //     });
    
            // } else {
     
            //     $_SESSION['errorMessage'] = 'Vous devez renseigner une date pour le jeu.';
    
            //     $view = new View();
            //     $view->redirect('edit-game');
            // }


            // echo "<pre>";
            // print_r($params);
            // echo "</pre>";die;

            // // Add game informations
            // // GameManager already launched
            // $game_id = $gameManager->addGame($params);

            // // Add games developers
            // $developerManager = new DeveloperManager();
            // foreach($params['developer'] as $developer_id) {

            //     $developerManager->addGameDeveloper($game_id, $developer_id);
            // }

            // // Add games genres
            // $genreManager = new GenreManager();
            // foreach($params['genre'] as $genre_id) {

            //     $genreManager->addGameGenre($game_id, $genre_id);
            // }

            // // Add games modes
            // $modeManager = new ModeManager();
            // foreach($params['mode'] as $mode_id) {
                
            //     $modeManager->addGameMode($game_id, $mode_id);
            // }

            // // Add games release
            // $releaseDateManager = new ReleaseDateManager();
            // foreach($params['releaseDate'] as $releaseDate_array) {
                
            //     $releaseDateManager->addReleaseDate($game_id, $releaseDate_array);
            // }

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

            extract($params); // Allows to extract the $id variable

            $game_id = $id;

            // // Delete game developers
            // $developerManager = new DeveloperManager();
            // $developerManager->deleteGameDevelopers($game_id);

            // // Delete games genres
            // $genreManager = new GenreManager();
            // $genreManager->deleteGameGenres($params['id']);

            // // Delete games modes
            // $modeManager = new ModeManager();
            // $modeManager->deleteGameModes($params['id']);

            // // Delete games release
            // $releaseDateManager = new ReleaseDateManager();
            // $releaseDateManager->deleteGameReleaseDates($params['id']);

            // // Delete game informations
            // $gameManager = new GameManager();
            // $gameManager->deleteGame($params['id']);

            // $view = new View();
            // $view->redirect('home');

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
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;
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