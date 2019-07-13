<?php

namespace App\controller;

use App\Core\View;
// use App\Controller\ConnectionController;

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

        if (!ConnectionController::isSessionValid()) {
            $view->render('front');
        } else {
            $view->render('back');
        }

    }

}