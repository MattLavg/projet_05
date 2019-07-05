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
use App\Core\Registry;
// use App\Model\CommentManager;
use App\Model\Pagination;
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

            $gameManager = new GameManager();

            $totalNbRows = $gameManager->count();
            $url = HOST . 'game-management';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 3);

            // if descendant order wanted, set $desc on true
            $desc = false;

            // set the name of element you want the list ordered by 
            $orderBy = 'name';

            $games = $gameManager->getAll($orderBy, $desc, $pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $renderPagination = false;

            if ($pagination->getEnoughEntries()) {
                $renderPagination = true;
            }

            $view = new View('gameManagement');
            $view->render('back', array(
                'games' => $games,
                'pagination' => $pagination,
                'renderPagination' => $renderPagination,
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
        // echo "</pre>";die;

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
                        
                    } else {
                        $_SESSION['errorMessage'] = 'L\'image doit être aux formats jpg, jpeg, gif ou png.';

                        $view = new View();
                        $view->redirect('edit-game');
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

            try {

                $db = Registry::getDb();
                
                $db->beginTransaction();

                // Add game informations (name, content, cover)
                $game_id = $gameManager->addGame($params, $fileExtension);

                if (!$game_id) {
                    throw new \Exception('Impossible d\'enregistrer les informations du jeu');
                } 

                // Add game cover in folder
                if ($validCover) {

                    // Validate file and store it in "covers" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/cover_game_id_' . $game_id . '.' . $fileInfos['extension']
                    );
                } else {
                    throw new \Exception('Impossible d\'enregistrer l\'image du jeu');
                }

                // Add games developers
                $developerManager = new DeveloperManager();
                foreach($params['developer'] as $developer_id) {

                    $addedDeveloper = $developerManager->addGameDeveloper($game_id, $developer_id);

                    if (!$addedDeveloper) {
                        throw new \Exception('Impossible d\'enregistrer le ou les développeurs du jeu');
                    }
                }

                // Add games genres
                $genreManager = new GenreManager();
                foreach($params['genre'] as $genre_id) {

                    $addedGenre = $genreManager->addGameGenre($game_id, $genre_id);

                    if (!$addedGenre) {
                        throw new \Exception('Impossible d\'enregistrer le ou les genres du jeu');
                    }
                }

                // Add games modes
                $modeManager = new ModeManager();
                foreach($params['mode'] as $mode_id) {
                    
                    $addedMode = $modeManager->addGameMode($game_id, $mode_id);

                    if (!$addedMode) {
                        throw new \Exception('Impossible d\'enregistrer le ou les modes du jeu');
                    }
                }

                // Add games release
                $releaseDateManager = new ReleaseDateManager();
                foreach($params['releaseDate'] as $releaseDate_array) {
                    
                    $addedRelease = $releaseDateManager->addReleaseDate($game_id, $releaseDate_array);

                    if (!$addedRelease) {
                        throw new \Exception('Impossible d\'enregistrer les dates du jeu');
                    }
                }

                $db->commit();

            } catch (\Exception $e) {

                $db->rollBack();

                $_SESSION['errorMessage'] = $e->getMessage();;

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
        // echo "</pre>";

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

            // $gameManager = new GameManager();
            // $games = $gameManager->getAll();

            // // Check if game already exists
            // $result = array_search($params['name'], $games);

            // if ($result) {
                
            //     $_SESSION['errorMessage'] = 'Le jeu existe déjà.';

            //     $view = new View();
            //     $view->redirect('edit-game/id/' . $game_id);

            // }

            // Check if file is present
            if (isset($_FILES['cover']) && $_FILES['cover']['error']  == 0) {

                // Check file size
                if ($_FILES['cover']['size'] <= 3000000 ) {
                    $fileInfos = pathinfo($_FILES['cover']['name']);
                    $fileExtension = $fileInfos['extension'];
                    $authorizedExtensions = array('jpg', 'jpeg', 'gif', 'png');

                    $validCover = false;

                    if (in_array($fileExtension, $authorizedExtensions)) {

                        $validCover = true;
                        
                    } else {
                        $_SESSION['errorMessage'] = 'L\'image doit être aux formats jpg, jpeg, gif ou png.';

                        $view = new View();
                        $view->redirect('edit-game');
                    }

                } else {

                    $_SESSION['errorMessage'] = 'L\'image ne doit pas dépasser les 3 Mo.';

                    $view = new View();
                    $view->redirect('edit-game/id/' . $game_id);

                }

            } else {
                $fileExtension = false;
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


            try {

                $db = Registry::getDb();
                
                $db->beginTransaction();

                
                $gameManager = new GameManager();

                // Get the game to access cover_extension
                $game = $gameManager->getGame($game_id);


                // Add game cover in folder
                if (isset($validCover) && $validCover == true) {

                    // Delete current game cover
                    if (file_exists(IMAGE .'covers/cover_game_id_' . $game->getId() . '.' . $game->getCover_extension())) {
                        unlink(IMAGE .'covers/cover_game_id_' . $game->getId() . '.' . $game->getCover_extension());
                    }

                    // Validate file and store it in "covers" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/cover_game_id_' . $game_id . '.' . $fileInfos['extension']
                    );
                }

                // Update game informations (name, content, cover)
                $gameManager->updateGame($params, $fileExtension, $game_id);

                // Delete game developers before adding new ones
                $developerManager = new DeveloperManager();
                $developerManager->deleteGameDevelopers($game_id);
                // Add games developers
                foreach($params['developer'] as $developer_id) {

                    $addedDeveloper = $developerManager->addGameDeveloper($game_id, $developer_id);

                    if (!$addedDeveloper) {
                        throw new \Exception('Impossible d\'enregistrer le ou les développeurs du jeu');
                    }
                }

                // Delete games genres
                $genreManager = new GenreManager();
                $genreManager->deleteGameGenres($game_id);
                // Add games genres
                foreach($params['genre'] as $genre_id) {

                    $addedGenre = $genreManager->addGameGenre($game_id, $genre_id);

                    if (!$addedGenre) {
                        throw new \Exception('Impossible d\'enregistrer le ou les genres du jeu');
                    }
                }

                // Delete games modes
                $modeManager = new ModeManager();
                $modeManager->deleteGameModes($game_id);
                // Add games modes
                foreach($params['mode'] as $mode_id) {
                    
                    $addedMode = $modeManager->addGameMode($game_id, $mode_id);

                    if (!$addedMode) {
                        throw new \Exception('Impossible d\'enregistrer le ou les modes du jeu');
                    }
                }

                // Delete games release
                $releaseDateManager = new ReleaseDateManager();
                $releaseDateManager->deleteGameReleaseDates($game_id);
                // Add games release
                foreach($params['releaseDate'] as $releaseDate_array) {
                    
                    $addedRelease = $releaseDateManager->addReleaseDate($game_id, $releaseDate_array);

                    if (!$addedRelease) {
                        throw new \Exception('Impossible d\'enregistrer les dates du jeu');
                    }
                }

                $db->commit();

            } catch (\Exception $e) {

                $db->rollBack();

                $_SESSION['errorMessage'] = $e->getMessage();;

                $view = new View();
                $view->redirect('edit-game/id/' . $game_id);
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
            if (file_exists(IMAGE .'covers/cover_game_id_' . $game->getId() . '.' . $game->getCover_extension())) {
                unlink(IMAGE .'covers/cover_game_id_' . $game->getId() . '.' . $game->getCover_extension());
            }
            
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