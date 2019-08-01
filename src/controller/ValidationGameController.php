<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\UpdateByMemberGameManager;
use App\Model\UpdateByMemberDeveloperManager;
use App\Model\UpdateByMemberGenreManager;
use App\Model\UpdateByMemberModeManager;
use App\Model\UpdateByMemberReleaseDateManager;
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

            $view = new View('gamesToValidate');
            $view->render('back', array(
                'games' => $gamesToValidate, 
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

        $updatedParams = [];

        // Get all the updated informations for a game
        $updateByMemberGameManager = new UpdateByMemberGameManager();
        $updatedGame = $updateByMemberGameManager->getGameUpdatedByMember($game_id);

        $updateByMemberDeveloperManager = new UpdateByMemberDeveloperManager();
        $updatedDevelopers = $updateByMemberDeveloperManager->getDevelopersUpdatedByMember($game_id);

        foreach ($updatedDevelopers as $updatedDeveloper) {
            $updatedDevelopersArray [] = [$updatedDeveloper->getName() => $updatedDeveloper->getId()];
        }

        $updateByMemberGenreManager = new UpdateByMemberGenreManager();
        $updatedGenres = $updateByMemberGenreManager->getGenresUpdatedByMember($game_id);

        foreach ($updatedGenres as $updatedGenre) {
            $updatedGenresArray [] = [$updatedGenre->getName() => $updatedGenre->getId()];
        }

        $updateByMemberModeManager = new UpdateByMemberModeManager();
        $updatedModes = $updateByMemberModeManager->getModesUpdatedByMember($game_id);

        foreach ($updatedModes as $updatedMode) {
            $updatedModesArray [] = [$updatedMode->getName() => $updatedMode->getId()];
        }

        $updateByMemberReleaseDateManager = new UpdateByMemberReleaseDateManager();
        $updatedReleases = $updateByMemberReleaseDateManager->getReleasesUpdatedByMember($game_id);

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

        // recreate same array as an update
        $updatedParams = [
            'id' => $updatedGame->getId(),
            'name' => $updatedGame->getName(),
            'content' => $updatedGame->getContent(),
            'developer' => $updatedDevelopersArray,
            'genre' => $updatedGenresArray,
            'mode' => $updatedModesArray,
            'releaseDate' => $updatedReleasesArray
        ];

        var_dump($updatedReleases);

        echo "<pre>";
        print_r($updatedParams);
        echo "</pre>";die;
        
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

        // delete all updated elements linked to the game
        $updateByMemberDeveloperManager = new UpdateByMemberDeveloperManager();
        $updateByMemberDeveloperManager->deleteGameDeveloperUpdatedByMember($game_id);

        $updateByMemberGenreManager = new UpdateByMemberGenreManager();
        $updateByMemberGenreManager->deleteGameGenresUpdatedByMember($game_id);

        $updateByMemberModeManager = new UpdateByMemberModeManager();
        $updateByMemberModeManager->deleteGameModesUpdatedByMember($game_id);

        $updateByMemberReleaseDateManager = new UpdateByMemberReleaseDateManager();
        $updateByMemberReleaseDateManager->deleteGameReleasesUpdatedByMember($game_id);

        $updateByMemberGameManager = new UpdateByMemberGameManager();
        $updatedGame = $updateByMemberGameManager->getGameUpdatedByMember($game_id);

        // Delete game cover
        if (file_exists(IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $updatedGame->getCover_extension())) {
            unlink(IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $updatedGame->getCover_extension());
        }

        $updateByMemberGameManager->deleteGameUpdatedByMember($game_id);

        // set to 0 the "updated by member" column of the game
        $gameManager = new GameManager();
        $gameManager->updatedByMember($game_id, false);

        $_SESSION['actionDone'] = 'Vous avez supprimé les modifications apportées au jeu.';

        $view = new View();
        $view->redirect('updated-game-member');
    }
 }