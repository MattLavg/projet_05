<?php

namespace App\Controller;

use App\Model\CommentManager;
use App\Core\View;
use App\Model\Pagination;

/**
 *  CommentController
 * 
 *  Allows to add, report and delete comments
 */

class CommentController
{
    /**
     * Allows to add comment
     * 
     * @param array $params
     */
    public function addComment($params = [])
    {
        $params['content'] = trim(strip_tags($params['content']));

        if (!empty($params['game-id']) && !empty($params['member-id']) && !empty($params['content'])) {

            $commentManager = new CommentManager();
            $commentId = $commentManager->addComment($params);

            if ($commentId) {
                $_SESSION['actionDone'] = 'Votre commentaire a bien été publié.';
            }

            $view = new View();
            $view->redirect('game/id/' . $params['game-id'] . '#anchorGame');

        } else {

            $_SESSION['errorMessage'] = 'Vous devez renseigner un message.';

            $view = new View();
            $view->redirect('game/id/' . $params['game-id'] . '#anchorGame');
        }
    }

    /**
     * Allows to delete comment
     * 
     * @param array $params
     */
    public function deleteComment($params)
    { 
        $commentManager = new CommentManager();
        $commentManager->deleteComment($params['id']);

        $_SESSION['actionDone'] = 'Vous avez supprimé un commentaire.';

        if (isset($params['game-id'])) {
            $view = new View();
            $view->redirect('game/id/' . $params['game-id'] . '#anchorGame');
        } else {
            $view = new View();
            $view->redirect('reported-comments');
        }
    }

    /**
     * Allows to report comment
     * 
     * @param array $params
     */
    public function reportComment($params)
    {
        $commentManager = new CommentManager();
        $isReportedComment = $commentManager->isReportedComment($params['id']);

        if ($isReportedComment['reported'] == 1) {

            $_SESSION['actionDone'] = 'Le commentaire a déjà été signalé.';

        } else {

            $reportedComment = $commentManager->reportComment($params['id']);

            if ($reportedComment) {
                $_SESSION['actionDone'] = 'Le commentaire a bien été signalé.';
            }

        }

        $view = new View();
        $view->redirect('game/id/' . $params['game-id'] . '#anchorGame');
    }

    /**
     * Allows to validate comment
     * 
     * @param array $params
     */
    public function validComment($params)
    {
        $commentManager = new CommentManager();
        $commentManager->validComment($params['id']);

        $_SESSION['actionDone'] = 'Le commentaire a été publié.';

        if (isset($params['game-id'])) {
            $view = new View();
            $view->redirect('game/id/' . $params['game-id'] . '#anchorGame');
        } else {
            $view = new View();
            $view->redirect('reported-comments');
        }
    }

    /**
     * Allows to show the reported comments page
     * 
     * @param array $params optionnal
     */
    public function showReportedComments($params = [])
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

            $commentManager = new CommentManager();

            $totalNbRows = $commentManager->countReportedComments();
            $url = HOST . 'reported-comments';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 10);

            $reportedComments = $commentManager->listReportedComments($pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $renderPagination = false;

            if ($pagination->getEnoughEntries()) {
                $renderPagination = true;
            }

            $jsFiles = [
                ASSETS . 'js/modal.js'
            ];

            $view = new View('reportedComments');
            $view->render('back', array(
                'comments' => $reportedComments, 
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
}