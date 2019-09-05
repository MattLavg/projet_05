<?php

namespace App\Controller;

use App\Core\View;

/**
 *  ErrorController
 * 
 *  Allows to display errors
 */

class ErrorController 
{
    /**
     * Allows to show the error page
     */
    public function showError() {

        $view = new View('error');

        if (ConnectionController::isSessionValid()) {

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            $view->render('front', array(
                'connected' => ConnectionController::isSessionValid(),
                'member' => $currentMember
            ));
        } else {
            $view->render('front');
        }
    }
}