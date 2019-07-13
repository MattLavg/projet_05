<?php

namespace App\Controller;

use App\Controller\ConnectionController;
use App\Model\GameManager;
use App\Model\DeveloperManager;
// use App\Model\CommentManager;
// use App\Model\Pagination;
use App\Core\View;

/**
 *  BackController
 * 
 *  Allows to show the edit, the post-management and the reported comments pages
 */

class BackController
{
    /**
     * Allows to show the edit page
     * 
     * @param array $params
     */
    public function showEdit($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            // Default error message to null
            $errorMessage = null;

            // if user try to post empty fields
            if (isset($_SESSION['errorMessage'])) {
                $errorMessage = $_SESSION['errorMessage'];
            }

            if (isset($params['id'])) {

                extract($params); // Allows to extract the $id variable

                $postManager = new PostManager();
                $post = $postManager->getPost($id);

                $view = new View('edit');
                $view->render('back', array('post' => $post, 'errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            } else {

                $view = new View('edit');
                $view->render('back', array('errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            }

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to show the posts management page
     * 
     * @param array $params optionnal
     */
    public function showPostsManagement($params = [])
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

            $postManager = new PostManager();

            $totalNbRows = $postManager->count();
            $url = HOST . 'post-management';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 15);
            
            $posts = $postManager->listPosts($pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $view = new View('postManagement');
            $view->render('back', array(
                'posts' => $posts, 
                'pagination' => $pagination,
                'isSessionValid' => ConnectionController::isSessionValid(),
                'actionDone' => $actionDone));

            unset($_SESSION['actionDone']);

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    
    
}