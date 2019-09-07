<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Authentication;
use App\Model\MemberManager;

/**
 *  ConnectionController
 * 
 *  Allows to show the connection page, to check the login, to log out and to check if the connection is valid
 */

class ConnectionController
{
    /**
     * Allows to show the connection page
     */
    public function showConnection()
    {
        if ($this->isConnected()) {

            $view = new View();
            $view->redirect('home');

        } else {

            $jsFiles = [
                ASSETS . 'js/checkForm.js'
            ];

            $view = new View('connection');
            $view->render('front', array(
                'jsFiles' => $jsFiles
            ));
        }
    }

    /**
     * Allows to check the login in the database
     * 
     * @param array $params
     */
    public function loginCheck($params)
    {
        // Default SESSION['valid'] to false
        $_SESSION['connected'] = false;

        if (isset($params['mail']) && isset($params['password']) && !empty($params['mail']) && !empty($params['password'])) {

            $authentication = new Authentication();
            $authentication = $authentication->checkLogin($params['mail']);
  
            if ($params['mail'] == $authentication['mail'] && password_verify($params['password'], $authentication['password'])) {
            
                $_SESSION['connected'] = true;

                $memberManager = new MemberManager();
                $member = $memberManager->getMemberByMail($params['mail']);

                $_SESSION['currentMember'] = $member;

                $memberManager->updateLastConnectionDate($member->getId());

                $_SESSION['actionDone'] = 'Heureux de vous revoir ' . $member->getNick_name() . ' !';
     
                $view = new View();
                $view->redirect('home');
    
            } else {
    
                $_SESSION['errorMessage'] = 'Les identifiants ne sont pas valides.';
    
                $view = new View();
                $view->redirect('connection');
            }

        } else  {
    
            $_SESSION['errorMessage'] = 'Veuillez renseigner les identifiants.';

            $view = new View();
            $view->redirect('connection');
            
        }
    }

    /**
     * Allows to log out
     */
    public function logOut()
    {
        $_SESSION['actionDone'] = 'Vous avez été déconnecté.';

        unset($_SESSION['connected']);
        unset($_SESSION['currentMember']);

        $view = new View();
        $view->redirect('home');
    }

    /**
     * Allows to check if the connection is valid
     * 
     * @return true|null
     */
    public static function isConnected()
    {
        if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
            return true;
        }

        return null;
    }
}