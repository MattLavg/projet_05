<?php

namespace App\Controller;

use App\Model\CommentManager;
use App\Core\View;

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
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;

        $params['game_id'] = trim(strip_tags($params['game_id']));
        $params['member_id'] = trim(strip_tags($params['member_id']));
        $params['content'] = trim(strip_tags($params['content']));

        if (!empty($params['game_id']) && !empty($params['member_id']) && !empty($params['content'])) {

            $commentManager = new CommentManager();
            $commentId = $commentManager->addComment($params);

            if ($commentId) {
                $_SESSION['actionDone'] = 'Votre commentaire a bien été publié.';
            }

            $view = new View();
            $view->redirect('game/id/' . $params['game_id'] . '#anchorGame');

        } else {

            $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs du formulaire.';

            $view = new View();
            $view->redirect('game/id/' . $params['game_id'] . '#anchorGame');
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
}