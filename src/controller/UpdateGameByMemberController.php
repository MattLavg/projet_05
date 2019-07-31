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
                $gameUpdatedByMember = $gameManager->updatedByMember($game_id);

                if (!$gameUpdatedByMember) {
                    throw new \Exception('Impossible de modifier le statut du jeu en indiquant la modification par un membre.');
                } 
                
                $updateByMemberGameManager = new UpdateByMemberGameManager();

                // Add game informations (name, content, cover) in "temporary" table
                // waiting for validation to be updated on the original table
                $updatedGame = $updateByMemberGameManager->addGameByMember($params, $fileExtension);

                if (!$updatedGame) {
                    throw new \Exception('Impossible d\'enregistrer les informations du jeu');
                } 

                // Add game cover in folder
                if (isset($validCover) && $validCover == true) {

                    // Validate file and store it in "temp" folder
                    move_uploaded_file(
                        $_FILES['cover']['tmp_name'],
                        IMAGE .'covers/temp/cover_game_id_' . $game_id . '.' . $fileInfos['extension']
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