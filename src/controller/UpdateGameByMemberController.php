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
// use App\Controller\ConnectionController;
use App\Core\View;

/**
 *  UpdateGameByMemberController
 * 
 *  Allows to update a game by a member
 */

 class UpdateGameByMemberController
 {
    /**
     * Allows to update a game by member by adding the modifications in a new table waiting for validation
     * 
     * @param array $params
     */
    public function updateGameByMember($params = [])
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
                $gameUpdatedByMember = $gameManager->updatedByMember($game_id, true);

                if (!$gameUpdatedByMember) {
                    throw new \Exception('Impossible de modifier le statut du jeu en indiquant la modification par un membre.');
                } 
                
                $updateByMemberGameManager = new UpdateByMemberGameManager();

                // Add game informations (name, content, cover) in "temporary" table
                // waiting for validation to be updated on the original table
                $updatedGame = $updateByMemberGameManager->addGameByMember($params, $file['fileExtension']);

                if (!$updatedGame) {
                    throw new \Exception('Impossible d\'enregistrer les informations du jeu');
                } 

                // Add game cover in folder
                if (isset($validCover) && $validCover == true) {

                    // Validate file and store it in "temp" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $file['fileExtension']
                    );
                }

                // Add games developers
                $updateByMemberDeveloperManager = new UpdateByMemberDeveloperManager();
                foreach($params['developer'] as $developer_id) {

                    $addedDeveloper = $updateByMemberDeveloperManager->addGameDeveloperByMember($game_id, $developer_id);

                    if (!$addedDeveloper) {
                        throw new \Exception('Impossible d\'enregistrer le ou les développeurs du jeu');
                    }
                }

                // Add games genres
                $updateByMemberGenreManager = new UpdateByMemberGenreManager();
                foreach($params['genre'] as $genre_id) {

                    $addedGenre = $updateByMemberGenreManager->addGameGenreByMember($game_id, $genre_id);

                    if (!$addedGenre) {
                        throw new \Exception('Impossible d\'enregistrer le ou les genres du jeu');
                    }
                }

                // Add games modes
                $updateByMemberModeManager = new UpdateByMemberModeManager();
                foreach($params['mode'] as $mode_id) {

                    $addedMode = $updateByMemberModeManager->addGameModeByMember($game_id, $mode_id);

                    if (!$addedMode) {
                        throw new \Exception('Impossible d\'enregistrer le ou les modes du jeu');
                    }
                }

                // Add games release
                $updateByMemberReleaseDateManager = new UpdateByMemberReleaseDateManager();
                foreach($params['releaseDate'] as $releaseDate_array) {

                    $addedRelease = $updateByMemberReleaseDateManager->addReleaseDateByMember($game_id, $releaseDate_array);

                    if (!$addedRelease) {
                        throw new \Exception('Impossible d\'enregistrer les dates du jeu');
                    }
                }

                $db->commit();

            } catch (\Exception $e) {

                $db->rollBack();

                $_SESSION['errorMessage'] = $e->getMessage();;

                $view = new View();
                $view->redirect('edit-game/id/' . $params['id']);
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
 }