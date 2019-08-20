<?php

namespace App\Model;

use App\Core\View;

/**
 * CheckData
 * 
 * Allows to check if data is valid
 */

class CheckData
{
    /**
     * Allows to check if data is not null
     * 
     * @param array $params
     * @param int $game_id
     */
    public function checkDataNotNull($params, $game_id = null)
    {
        // impossible to give the function a variable so i use SESSION
        if (!empty($game_id)) {
            $_SESSION['game_id'] = $game_id;
        }
        
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

                if (isset($_SESSION['game_id'])) {
                    $view->redirect('edit-game/id/' . $_SESSION['game_id']);
                } else {
                    $view->redirect('edit-game');
                }
                
            }
        });

        return $params;
    }

    /**
     * Allows to check if cover file is present and valid
     * 
     * @param int $game_id
     */
    public function checkFile($game_id = null)
    {
        // Check if file is present
        if (isset($_FILES['cover']) && $_FILES['cover']['error']  == 0) {

            // Check file size
            if ($_FILES['cover']['size'] <= 3000000 ) {
                $fileInfos = pathinfo($_FILES['cover']['name']);
                $fileExtension = $fileInfos['extension'];
                $authorizedExtensions = array('jpg', 'jpeg', 'gif', 'png');

                if (in_array($fileExtension, $authorizedExtensions)) {

                    $file = [
                        'validCover' => true, 
                        'fileExtension' => $fileExtension
                    ];

                    return $file;
                    
                } else {
                    $_SESSION['errorMessage'] = 'L\'image doit être aux formats jpg, jpeg, gif ou png.';

                    $view = new View();

                    if (!empty($game_id)) {
                        $view->redirect('edit-game/id/' . $game_id);
                    } else {
                        $view->redirect('edit-game');
                    }
                }

            } else {

                $_SESSION['errorMessage'] = 'L\'image ne doit pas dépasser les 3 Mo.';

                $view = new View();
                
                if (!empty($game_id)) {
                    $view->redirect('edit-game/id/' . $game_id);
                } else {
                    $view->redirect('edit-game');
                }

            }

        } else {

            // if $game_id, it's an update
            // cover is not mandatory
            if (!empty($game_id)) {

                $file = ['fileExtension' => null];

                return $file;
                
            } else {
                $_SESSION['errorMessage'] = 'Vous devez télécharger une image pour le jeu.';

                $view = new View();
                $view->redirect('edit-game');
            }
        }
    }

    /**
     * Allows to check if array contains integers as expected
     * 
     * @param array $entity
     * @param int $game_id
     */
    public function checkIntegers($entity, $game_id = 0)
    {
        // return array with successfull values
        $filterEntityArray = filter_var_array($entity, FILTER_VALIDATE_INT);

            // Check if somes values are false or null
            foreach ($filterEntityArray as $key => $value) {
                if (empty($value) || $value == false) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour développeur, non valide.';

                    $view = new View();

                    if (!empty($game_id)) {
                        $view->redirect('edit-game/id/' . $game_id);
                    } else {
                        $view->redirect('edit-game');
                    }
                }
            }
    }

    /**
     * Allows to check if array contains the expected values
     */
    public function checkReleaseDatesValues($releaseDates, $game_id = 0)
    {
        // impossible to give the function a variable so i use SESSION
        if (!empty($game_id)) {
            $_SESSION['game_id'] = $game_id;
        }

        // Allows to use a function on each element of multidimensionnal array
        array_walk_recursive($releaseDates, function($item, $key) {

            if ($key == 'platform' || $key == 'publisher' || $key == 'region') {

                if (!is_numeric($item)) {

                    $_SESSION['errorMessage'] = 'Valeur reçue pour support, éditeur ou region, non valide.';

                    $view = new View();
                    
                    if (isset($_SESSION['game_id'])) {
                        $view->redirect('edit-game/id/' . $_SESSION['game_id']);
                    } else {
                        $view->redirect('edit-game');
                    }
                }
            }
            if ($key == 'date') {
          
                $itemArray = explode('-', $item);

                if (!checkdate($itemArray[1], $itemArray[2], $itemArray[0])) {

                    $_SESSION['errorMessage'] = 'La date n\'est pas valide.';

                    $view = new View();
                    
                    if (isset($_SESSION['game_id'])) {
                        $view->redirect('edit-game/id/' . $_SESSION['game_id']);
                    } else {
                        $view->redirect('edit-game');
                    }
                }
            } 
        });
    }
}