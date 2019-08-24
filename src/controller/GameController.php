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
use App\Model\UpdateByMemberGameManager;
use App\Model\UpdateByMemberDeveloperManager;
use App\Model\UpdateByMemberGenreManager;
use App\Model\UpdateByMemberModeManager;
use App\Model\UpdateByMemberReleaseDateManager;
use App\Core\Registry;
use App\Model\CommentManager;
use App\Model\Pagination;
use App\model\CheckData;
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
        $currentMember = null;

        if (isset($_SESSION['currentMember'])) {
            $currentMember = $_SESSION['currentMember'];
        }

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

        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        }

        $commentManager = new CommentManager();

        $totalNbRows = $commentManager->count($game_id);
        $url = HOST . 'game/id/' . $game_id;

        $pagination = new Pagination($pageNb, $totalNbRows, $url, 10);

        $comments = $commentManager->listComments($game_id, $pagination->getFirstEntry(), $pagination->getElementNbByPage());

        $renderPagination = false;

        if ($pagination->getEnoughEntries()) {
            $renderPagination = true;
        }

        $view = new View('game');
        $view->render('front', array(
            'game' => $game,
            'developers' => $developers,
            'genres' => $genres,
            'modes' => $modes,
            'releases' => $releaseDates,
            'connected' => ConnectionController::isSessionValid(),
            'member' => $currentMember,
            'pagination' => $pagination,
            'renderPagination' => $renderPagination,
            'comments' => $comments
        ));

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

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            $gameManager = new GameManager();

            $totalNbRows = $gameManager->count();
            $url = HOST . 'game-management';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 3);

            // if descendant order wanted, set 'DESC' 
            // if not set ''
            $desc = ' ';

            // set the name of element you want the list ordered by 
            $orderBy = ' ORDER BY name';

            $games = $gameManager->getAll($orderBy, $desc, 'LIMIT ' . $pagination->getFirstEntry() . ',', $pagination->getElementNbByPage());

            $renderPagination = false;

            if ($pagination->getEnoughEntries()) {
                $renderPagination = true;
            }

            $view = new View('gameManagement');
            $view->render('back', array(
                'games' => $games,
                'pagination' => $pagination,
                'renderPagination' => $renderPagination,
                'isSessionValid' => ConnectionController::isSessionValid(),
                'member' => $currentMember
            ));

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

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
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
                $allDevelopers = $developerManager->getAll(' ORDER BY name');

                $genreManager = new GenreManager();
                $genres = $genreManager->getGenres($game_id);
                $allGenres = $genreManager->getAll(' ORDER BY name');

                $modeManager = new ModeManager();
                $modes = $modeManager->getModes($game_id);
                $allModes = $modeManager->getAll(' ORDER BY name');

                $platformManager = new PlatformManager();
                $allPlatforms = $platformManager->getAll(' ORDER BY name');

                $publisherManager = new PublisherManager();
                $allPublishers = $publisherManager->getAll(' ORDER BY name');

                $regionManager = new RegionManager();
                $allRegions = $regionManager->getAll(' ORDER BY name');

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
                    'member' => $currentMember
                ));

            } else {

                $developerManager = new DeveloperManager();
                $genreManager = new GenreManager();
                $modeManager = new ModeManager();
                $platformManager = new PlatformManager();
                $publisherManager = new PublisherManager();
                $regionManager = new RegionManager();

                $developers = $developerManager->getAll(' ORDER BY name');
                $genres = $genreManager->getAll(' ORDER BY name');
                $modes = $modeManager->getAll(' ORDER BY name');
                $platforms = $platformManager->getAll(' ORDER BY name');
                $publishers = $publisherManager->getAll(' ORDER BY name');
                $regions = $regionManager->getAll(' ORDER BY name');

                $view = new View('gameEdit');
                $view->render('back', array(
                    'developers' => $developers,
                    'genres' => $genres,
                    'modes' => $modes,
                    'platforms' => $platforms,
                    'publishers' => $publishers,
                    'regions' => $regions,
                    'member' => $currentMember
                ));

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

            // Check if data is not null
            // return a modified array
            $checkData = new CheckData();
            $params = $checkData->checkDataNotNull($params);

            $gameManager = new GameManager();
            $games = $gameManager->getAllNames();

            // Check if game already exists
            $result = array_search($params['name'], $games);

            if ($result) {
                
                $_SESSION['errorMessage'] = 'Le jeu existe déjà.';

                $view = new View();
                $view->redirect('edit-game');

            }

            // Check if file is valid
            $file = $checkData->checkFile();

            // Allows to delete duplicated entities
            $params['developer'] = array_unique($params['developer']);
            $params['genre'] = array_unique($params['genre']);
            $params['mode'] = array_unique($params['mode']);

            // Check if entity's array contains integers as expected
            $checkData->checkIntegers($params['developer']);
            $checkData->checkIntegers($params['genre']);
            $checkData->checkIntegers($params['mode']);

            // Check if releaseDates contain the expected values
            $checkData->checkReleaseDatesValues($params['releaseDate']);

            try {

                $db = Registry::getDb();
                
                $db->beginTransaction();

                // if it's a member
                if ($_SESSION['currentMember']->getId_Type() == 3) {
                    $game_id = $gameManager->addGame($params, $file['fileExtension'], $toValidate = 1);
                } else {
                    // Add game informations (name, content, cover)
                    $game_id = $gameManager->addGame($params, $file['fileExtension']);
                }

                if (!$game_id) {
                    throw new \Exception('Impossible d\'enregistrer les informations du jeu');
                } 

                // Add game cover in folder
                if ($file['validCover']) {

                    // Validate file and store it in "covers" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/cover_game_id_' . $game_id . '.' . $file['fileExtension']
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
     * @param bool $updateByMember, allows to know if the update is done by a member
     */
    public static function updateGame($params = [], $updateByMember = null, $updatedCoverFileExtension)
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;

        if (ConnectionController::isSessionValid()) {

            extract($params); // Allows to extract the $id variable

            $game_id = $id;

            // Check if data is not null
            // return a modified array
            $checkData = new CheckData();
            $params = $checkData->checkDataNotNull($params, $game_id);

            // Check if file is valid
            $file = $checkData->checkFile($game_id);

            // Allows to delete duplicated entities
            $params['developer'] = array_unique($params['developer']);
            $params['genre'] = array_unique($params['genre']);
            $params['mode'] = array_unique($params['mode']);

            // Check if entity's array contains integers as expected
            $checkData->checkIntegers($params['developer'], $game_id);
            $checkData->checkIntegers($params['genre'], $game_id);
            $checkData->checkIntegers($params['mode'], $game_id);

            // Check if releaseDates contain the expected values
            $checkData->checkReleaseDatesValues($params['releaseDate'], $game_id);


            try {

                $db = Registry::getDb();
                
                $db->beginTransaction();
                
                $gameManager = new GameManager();

                // Get the game to access cover_extension
                $game = $gameManager->getGame($game_id);

                // Add game cover in folder
                if (isset($file['validCover']) && $file['validCover'] == true) {

                    // Delete current game cover
                    if (file_exists(IMAGE .'covers/cover_game_id_' . $game->getId() . '.' . $game->getCover_extension())) {
                        unlink(IMAGE .'covers/cover_game_id_' . $game->getId() . '.' . $game->getCover_extension());
                    }

                    // Validate file and store it in "covers" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/cover_game_id_' . $game_id . '.' . $file['fileExtension']
                    );
                }

                // When updated by Member
                // And if updated cover exists
                if (!empty($updatedCoverFileExtension)) {
                    $gameManager->updateGame($params, $updatedCoverFileExtension, $game_id);
                } else {
                    // Update game informations (name, content, cover)
                    $gameManager->updateGame($params, $file['fileExtension'], $game_id);
                }

                

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

            if (isset($updateByMember) && $updateByMember == true) {

                $_SESSION['actionDone'] = 'Vous avez accepté les modifications apportées par la communauté sur ce jeu.';

                $view = new View();
                $view->redirect('updated-game-member');
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
     * Allows to delete a game and the associated comments
     * 
     * @param array $params
     */
    public function deleteGameAndComments($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;
        if (ConnectionController::isSessionValid()) {

            // if game is updated by member
            // delete all updated elements linked to the game
            $updateByMemberDeveloperManager = new UpdateByMemberDeveloperManager();
            $updateByMemberDeveloperManager->deleteGameDeveloperUpdatedByMember($params['id']);

            $updateByMemberGenreManager = new UpdateByMemberGenreManager();
            $updateByMemberGenreManager->deleteGameGenresUpdatedByMember($params['id']);

            $updateByMemberModeManager = new UpdateByMemberModeManager();
            $updateByMemberModeManager->deleteGameModesUpdatedByMember($params['id']);

            $updateByMemberReleaseDateManager = new UpdateByMemberReleaseDateManager();
            $updateByMemberReleaseDateManager->deleteGameReleasesUpdatedByMember($params['id']);

            $updateByMemberGameManager = new UpdateByMemberGameManager();
            $updateByMemberGameManager->deleteGameUpdatedByMember($params['id']);

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
            
            $gameManager->deleteGameAndComments($params['id']);

            $_SESSION['actionDone'] = 'Vous avez effacé un jeu.';

            if (isset($params['page']) && $params['page'] == 'added-game') {
                $view = new View();
                $view->redirect('added-game-member');
            }

            $view = new View();
            $view->redirect('game-management');

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

 }