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
        // echo "</pre>";

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

            // Check if file is present
            if (isset($_FILES['cover']) && $_FILES['cover']['error']  == 0) {

                // Check file size
                if ($_FILES['cover']['size'] <= 3000000 ) {
                    $fileInfos = pathinfo($_FILES['cover']['name']);
                    $fileExtension = $fileInfos['extension'];
                    $authorizedExtensions = array('jpg', 'jpeg', 'gif', 'png');

                    if (in_array($fileExtension, $authorizedExtensions)) {

                        $validCover = true;
                        
                    }

                } else {

                    $_SESSION['errorMessage'] = 'L\'image ne doit pas dépasser les 3 Mo.';

                    $view = new View();
                    $view->redirect('edit-game');

                }

            } else {

                $_SESSION['errorMessage'] = 'Vous devez télécharger une image pour le jeu.';

                $view = new View();
                $view->redirect('edit-game');

            }

            // Allows to delete duplicated developers
            $params['developer'] = array_unique($params['developer']);

            // Check if developer's array contains integers as expected
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

            // Check if genre's array contains integers as expected
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

            // Check if mode's array contains integers as expected
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


            // Allows to use a function on each element of multidimensionnal array
            array_walk_recursive($params['releaseDate'], function($item, $key) {

                if ($key == 'platform' || $key == 'publisher' || $key == 'region') {

                    if (!is_numeric($item)) {

                        $_SESSION['errorMessage'] = 'Valeur reçue pour support, éditeur ou region, non valide.';

                        $view = new View();
                        $view->redirect('edit-game');
                    }
                }
                if ($key == 'date') {
              
                    $itemArray = explode('-', $item);

                    if (!checkdate($itemArray[1], $itemArray[2], $itemArray[0])) {

                        $_SESSION['errorMessage'] = 'La date n\'est pas valide.';

                        $view = new View();
                        $view->redirect('edit-game');
                    }
                } 
            });


            // Add game informations
            $game_id = $gameManager->addGame($params);

            if ($game_id) {

                // Add game cover in folder
                if ($validCover) {

                    // Validate file and store it in "covers" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/cover_game_id_' . $game_id . '.' . $fileInfos['extension']
                    );
                }

                $cover = 'cover_game_id_' . $game_id . '.' . $fileInfos['extension'];
                // Add game cover name in bdd
                $addedCover [] = $gameManager->addCover($game_id, $cover);

                // Add games developers
                $developerManager = new DeveloperManager();
                foreach($params['developer'] as $developer_id) {

                    $addedDevelopers [] = $developerManager->addGameDeveloper($game_id, $developer_id);
                }

                // Add games genres
                $genreManager = new GenreManager();
                foreach($params['genre'] as $genre_id) {

                    $addedGenres [] = $genreManager->addGameGenre($game_id, $genre_id);
                }

                // Add games modes
                $modeManager = new ModeManager();
                foreach($params['mode'] as $mode_id) {
                    
                    $addedModes [] = $modeManager->addGameMode($game_id, $mode_id);
                }

                // Add games release
                $releaseDateManager = new ReleaseDateManager();
                foreach($params['releaseDate'] as $releaseDate_array) {
                    
                   $addedReleases [] = $releaseDateManager->addReleaseDate($game_id, $releaseDate_array);
                }

                $addedAll = array_merge($addedDevelopers, $addedGenres, $addedModes, $addedReleases);

                foreach($addedAll as $value) {
                    
                    if (empty($value) || $value == 0) {

                        if (!$_SESSION['errorMessage']) {

                            $_SESSION['errorMessage'] = 'Impossible d\'ajouter le jeu.';
                        }

                        // Delete game cover
                        unlink(IMAGE .'covers/cover_game_id_' . $game_id . '.' . $fileInfos['extension']);

                        // Delete game developers
                        $developerManager = new DeveloperManager();
                        $developerManager->deleteGameDevelopers($game_id);

                        // Delete games genres
                        $genreManager = new GenreManager();
                        $genreManager->deleteGameGenres($game_id);

                        // Delete games modes
                        $modeManager = new ModeManager();
                        $modeManager->deleteGameModes($game_id);

                        // Delete games release
                        $releaseDateManager = new ReleaseDateManager();
                        $releaseDateManager->deleteGameReleaseDates($game_id);

                        // Delete game informations
                        $gameManager = new GameManager();
                        $gameManager->deleteGame($game_id);

                        $view = new View();
                        $view->redirect('edit-game');
                    }
                 }

            } else {

                $_SESSION['errorMessage'] = 'Impossible d\'ajouter le jeu.';

                $view = new View();
                $view->redirect('edit-game');

            }

            // if game added, display home
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
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;

        echo "<pre>";
        print_r($_SESSION['savedParams']);
        echo "</pre>";die;

        if (ConnectionController::isSessionValid()) {

            extract($params); // Allows to extract the $id variable

            $game_id = $id;

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
                    $view->redirect('edit-game/id/' . $game_id);
                }
            });

            $gameManager = new GameManager();
            $games = $gameManager->getAllNames();

            // Check if game already exists
            $result = array_search($params['name'], $games);

            if ($result) {
                
                $_SESSION['errorMessage'] = 'Le jeu existe déjà.';

                $view = new View();
                $view->redirect('edit-game/id/' . $game_id);

            }

            // Check if file is present
            if (isset($_FILES['cover']) && $_FILES['cover']['error']  == 0) {

                // Check file size
                if ($_FILES['cover']['size'] <= 3000000 ) {
                    $fileInfos = pathinfo($_FILES['cover']['name']);
                    $fileExtension = $fileInfos['extension'];
                    $authorizedExtensions = array('jpg', 'jpeg', 'gif', 'png');

                    if (in_array($fileExtension, $authorizedExtensions)) {

                        $validCover = true;
                        
                    }

                } else {

                    $_SESSION['errorMessage'] = 'L\'image ne doit pas dépasser les 3 Mo.';

                    $view = new View();
                    $view->redirect('edit-game/id/' . $game_id);

                }

            } elseif (!isset($_FILE['cover'])) {

                $game = $gameManager->getGame($game_id);

                if (!$game->getCover()) {

                    $_SESSION['errorMessage'] = 'Vous devez télécharger une image pour le jeu.';

                    $view = new View();
                    $view->redirect('edit-game/id/' . $game_id);

                }

            } else {

                $_SESSION['errorMessage'] = 'Vous devez télécharger une image pour le jeu.';

                $view = new View();
                $view->redirect('edit-game/id/' . $game_id);

            }

            // Allows to delete duplicated developers
            $params['developer'] = array_unique($params['developer']);

            // Check if developer's array contains integers as expected
            // return array with successfull values
            $filterDeveloperArray = filter_var_array($params['developer'], FILTER_VALIDATE_INT);

            // Check if somes values are false or null
            foreach ($filterDeveloperArray as $key => $value) {
                if (empty($value) || $value == false) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour développeur, non valide.';

                    $view = new View();
                    $view->redirect('edit-game/id/' . $game_id);
                }
            }

            // Allows to delete duplicated genres
            $params['genre'] = array_unique($params['genre']);

            // Check if genre's array contains integers as expected
            // return array with successfull values
            $filterGenreArray = filter_var_array($params['genre'], FILTER_VALIDATE_INT);

            // Check if somes values are false or null
            foreach ($filterGenreArray as $key => $value) {
                if (empty($value) || $value == false) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour genre, non valide.';

                    $view = new View();
                    $view->redirect('edit-game/id/' . $game_id);
                }
            }

            // Allows to delete duplicates modes
            $params['mode'] = array_unique($params['mode']);

            // Check if mode's array contains integers as expected
            // return array with successfull values
            $filterModeArray = filter_var_array($params['mode'], FILTER_VALIDATE_INT);

            // Check if somes values are false or null
            foreach ($filterModeArray as $key => $value) {
                if (empty($value) || $value == false) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour mode, non valide.';

                    $view = new View();
                    $view->redirect('edit-game/id/' . $game_id);
                }
            }


            // Allows to use a function on each element of multidimensionnal array
            array_walk_recursive($params['releaseDate'], function($item, $key) {

                if ($key == 'platform' || $key == 'publisher' || $key == 'region') {

                    if (!is_numeric($item)) {

                        $_SESSION['errorMessage'] = 'Valeur reçue pour support, éditeur ou region, non valide.';

                        $view = new View();
                        $view->redirect('edit-game/id/' . $game_id);
                    }
                }
                if ($key == 'date') {
              
                    $itemArray = explode('-', $item);

                    if (!checkdate($itemArray[1], $itemArray[2], $itemArray[0])) {

                        $_SESSION['errorMessage'] = 'La date n\'est pas valide.';

                        $view = new View();
                        $view->redirect('edit-game/id/' . $game_id);
                    }
                } 
            });


            // Update game informations

            if ($game_id) {

                // Add game cover in folder
                if ($validCover) {

                    // Validate file and store it in "covers" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/cover_game_id_' . $game_id . '.' . $fileInfos['extension']
                    );
                }

                $cover = 'cover_game_id_' . $game_id . '.' . $fileInfos['extension'];
                // Add game cover name in bdd
                $updatedCover [] = $gameManager->updateCover($game_id, $cover);

                // Add games developers
                $developerManager = new DeveloperManager();
                foreach($params['developer'] as $developer_id) {

                    $addedDevelopers [] = $developerManager->addGameDeveloper($game_id, $developer_id);
                }

                // Add games genres
                $genreManager = new GenreManager();
                foreach($params['genre'] as $genre_id) {

                    $addedGenres [] = $genreManager->addGameGenre($game_id, $genre_id);
                }

                // Add games modes
                $modeManager = new ModeManager();
                foreach($params['mode'] as $mode_id) {
                    
                    $addedModes [] = $modeManager->addGameMode($game_id, $mode_id);
                }

                // Add games release
                $releaseDateManager = new ReleaseDateManager();
                foreach($params['releaseDate'] as $releaseDate_array) {
                    
                   $addedReleases [] = $releaseDateManager->addReleaseDate($game_id, $releaseDate_array);
                }

                $addedAll = array_merge($addedDevelopers, $addedGenres, $addedModes, $addedReleases);

                foreach($addedAll as $value) {
                    
                    if (empty($value) || $value == 0) {

                        if (!$_SESSION['errorMessage']) {

                            $_SESSION['errorMessage'] = 'Impossible d\'ajouter le jeu.';
                        }

                        // Delete game cover
                        unlink(IMAGE .'covers/cover_game_id_' . $game_id . '.' . $fileInfos['extension']);

                        // Delete game developers
                        $developerManager = new DeveloperManager();
                        $developerManager->deleteGameDevelopers($game_id);

                        // Delete games genres
                        $genreManager = new GenreManager();
                        $genreManager->deleteGameGenres($game_id);

                        // Delete games modes
                        $modeManager = new ModeManager();
                        $modeManager->deleteGameModes($game_id);

                        // Delete games release
                        $releaseDateManager = new ReleaseDateManager();
                        $releaseDateManager->deleteGameReleaseDates($game_id);

                        // Delete game informations
                        $gameManager = new GameManager();
                        $gameManager->deleteGame($game_id);

                        $view = new View();
                        $view->redirect('edit-game');
                    }
                 }

            } else {

                $_SESSION['errorMessage'] = 'Impossible d\'ajouter le jeu.';

                $view = new View();
                $view->redirect('edit-game');

            }

            // if game added, display home
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

            // Delete game informations and cover in folder
            $gameManager = new GameManager();
            
            $game = $gameManager->getGame($params['id']);

            // Delete game cover
            unlink(IMAGE .'covers/' . $game->getCover());

            $gameManager->deleteGame($params['id']);

            $_SESSION['actionMessage'] = 'Vous avez effacé un jeu.';

            $view = new View();
            $view->redirect('game-management');

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

 }