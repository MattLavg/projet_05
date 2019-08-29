<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\DeveloperManager;
use App\Model\GenreManager;
use App\Model\ModeManager;
use App\Model\ReleaseDateManager;
use App\Model\Pagination;
use App\Core\View;

/**
 * ValidationGameController
 * 
 * Allows to show validation pages for adding or updating a game by a member
 * Allows to validate a game added by a member
 */

 class ValidationGameController
 {
    /**
     * Allows to show the validation page for added games by members
     */
    public function showAddedGamesValidation($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            }

            $gameManager = new GameManager();

            $totalNbRows = $gameManager->countGamesToValidate();
            $url = HOST . 'added-game-member';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 10);

            $gamesToValidate = $gameManager->getAll(' ', ' ', 'LIMIT ' . $pagination->getFirstEntry() . ',', $pagination->getElementNbByPage(), ' WHERE to_validate = 1');

            $renderPagination = false;

            if ($pagination->getEnoughEntries()) {
                $renderPagination = true;
            }

            $jsFiles = [
                ASSETS . 'js/modal.js'
            ];

            $view = new View('gamesToValidate');
            $view->render('back', array(
                'games' => $gamesToValidate, 
                'pagination' => $pagination,
                'renderPagination' => $renderPagination,
                'member' => $currentMember,
                'jsFiles' => $jsFiles
            ));

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }

    }

    /**
     * Allows to show the validation page for updated games by members
     */
    public function showUpdatedGamesValidation($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            }

            $gameManager = new GameManager();

            $totalNbRows = $gameManager->countGamesUpdatedByMembers();
            $url = HOST . 'updated-game-member';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 10);

            $gamesUpdatedByMembers = $gameManager->getAll(' ', ' ', 'LIMIT ' . $pagination->getFirstEntry() . ',', $pagination->getElementNbByPage(), ' WHERE updated_by_member = 1');

            $renderPagination = false;

            if ($pagination->getEnoughEntries()) {
                $renderPagination = true;
            }

            $view = new View('updatedGamesToValidate');
            $view->render('back', array(
                'games' => $gamesUpdatedByMembers, 
                'pagination' => $pagination,
                'renderPagination' => $renderPagination,
                'member' => $currentMember
            ));

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }

    }

    /**
     * Allows to validate the added game
     * 
     * @param array $params
     */
    public function validateGame($params = [])
    {
        extract($params); // Allows to extract the $id variable

        $game_id = $id; // rename the variable for better identification

        $gameManager = new GameManager();
        $validatedGame = $gameManager->validateGame($game_id);

        if (!$validatedGame) {'Le jeu n\'a pas pu être validé.';

            $view = new View();
            $view->redirect('added-game-member');
        }

        $_SESSION['actionDone'] = 'Vous avez accepté le jeu ajouté par la communauté.';

        $view = new View();
        $view->redirect('added-game-member');
    }

    /**
     * Allows to validate the updated modifications for a game by a member
     * 
     * @param array $params
     */
    public function validateUpdateByMember($params = [])
    {
        extract($params); // Allows to extract the $id variable
        $game_id = $id; // rename the variable for better identification

        $gameManager = new GameManager();
        $developerManager = new DeveloperManager();
        $genreManager = new GenreManager();
        $modeManager = new ModeManager();
        $releaseDateManager = new ReleaseDateManager();

        // Get all the updated informations for a game
        $updatedGame = $gameManager->getGame($game_id, true);

        $updatedDevelopers = $developerManager->getGameDevelopers($game_id, true);

        foreach ($updatedDevelopers as $updatedDeveloper) {
            $updatedDevelopersArray [] =  $updatedDeveloper->getId();
        }

        $updatedGenres = $genreManager->getGameGenres($game_id, true);

        foreach ($updatedGenres as $updatedGenre) {
            $updatedGenresArray [] = $updatedGenre->getId();
        }

        $updatedModes = $modeManager->getGameModes($game_id, true);

        foreach ($updatedModes as $updatedMode) {
            $updatedModesArray [] = $updatedMode->getId();
        }

        $updatedReleases = $releaseDateManager->getGameReleases($game_id, true);

        foreach ($updatedReleases as $updatedRelease) {

            $date = explode('/', $updatedRelease->getReleaseDate());
            $date = $date[2] . '-' . $date[1] . '-' . $date[0];

            $updatedReleasesArray [] = [
                'platform' => $updatedRelease->getPlatformId(),
                'publisher' => $updatedRelease->getPublisherId(),
                'region' => $updatedRelease->getRegionId(),
                'date' => $date
            ];
        }

        $updatedParams = [];

        // recreate same array as for an update
        $updatedParams = [
            'id' => $updatedGame->getId(),
            'name' => $updatedGame->getName(),
            'content' => $updatedGame->getContent(),
            'developer' => $updatedDevelopersArray,
            'genre' => $updatedGenresArray,
            'mode' => $updatedModesArray,
            'releaseDate' => $updatedReleasesArray
        ];

        $updatedCoverFileExtension = null;

        // Get the file extension of updated game
        if (!empty($updatedGame->getCover_extension())) {
            $updatedCoverFileExtension = $updatedGame->getCover_extension();
        }

        // Change the status of the "updated_by_member" column to "0"
        $gameManager->updatedByMember($game_id, false);

        // Get the game to access cover_extension
        $game = $gameManager->getGame($game_id);

        if (file_exists(IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $updatedGame->getCover_extension())) {
            // Delete game cover
            unlink(IMAGE .'covers/cover_game_id_' . $game_id . '.' . $game->getCover_extension());

            rename(
                IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $updatedGame->getCover_extension(),
                IMAGE .'covers/cover_game_id_' . $game_id . '.' . $updatedGame->getCover_extension()
            );
        }

        // delete all updated elements linked to the game
        $developerManager->deleteGameDevelopers($game_id, true);
        $genreManager->deleteGameGenres($game_id, true);
        $modeManager->deleteGameModes($game_id, true);
        $releaseDateManager->deleteGameReleaseDates($game_id, true);
        $gameManager->deleteGameUpdatedByMember($game_id);

        GameController::updateGame($updatedParams, $updateByMember = true, $updatedCoverFileExtension);

        

        // var_dump($updatedDevelopers);

        // echo "<pre>";
        // print_r($updatedParams);
        // echo "</pre>";die;
        
    }

    /**
     * Allows to cancel updated modifications for a game by a member
     * 
     * @param array $params
     */
    public function deleteUpdateByMember($params = [])
    {
        extract($params); // Allows to extract the $id variable
        $game_id = $id; // rename the variable for better identification

        $gameManager = new GameManager();
        $developerManager = new DeveloperManager();
        $genreManager = new GenreManager();
        $modeManager = new ModeManager();
        $releaseDateManager = new ReleaseDateManager();

        // delete all updated elements linked to the game
        $developerManager->deleteGameDevelopers($game_id, true);
        $genreManager->deleteGameGenres($game_id, true);
        $modeManager->deleteGameModes($game_id, true);
        $releaseDateManager->deleteGameReleaseDates($game_id, true);

        // Get the updated game to access cover extension
        $updatedGame = $gameManager->getGame($game_id, true);

        // Delete game cover
        if (file_exists(IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $updatedGame->getCover_extension())) {
            unlink(IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $updatedGame->getCover_extension());
        }

        $gameManager->deleteGameUpdatedByMember($game_id);

        // Change the status of the "updated_by_member" column to "0"
        $gameManager->updatedByMember($game_id, false);

        $_SESSION['actionDone'] = 'Vous avez supprimé les modifications apportées au jeu.';

        $view = new View();
        $view->redirect('updated-game-member');
    }
 }