<?php

namespace App\Controller;

use App\Model\GameManager;
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
 }