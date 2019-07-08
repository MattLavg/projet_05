<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Core\View;

/**
 *  MemberController
 * 
 *  Allows to show, add, update and delete members
 */

 class MemberController
 {
    /**
     * Allows to show informations member
     * 
     * @param array $params
     */
    public function showInformationsMember($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";

        if (ConnectionController::isSessionValid()) {

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            $view = new View('memberInfos');
            $view->render('back', array(
                'member' => $currentMember,
                'connected' => ConnectionController::isSessionValid()
            ));


        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to edit members informations
     * 
     * @param array $params
     */
    public function showEditMember($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            $view = new View('memberEdit');
            $view->render('back', array(
                'member' => $currentMember,
                'connected' => ConnectionController::isSessionValid()
            ));


        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to add a member
     * 
     * @param array $params
     */
    public function addMember($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";

        // Default SESSION['valid'] to false
        $_SESSION['valid'] = false;

        array_walk($params, function(&$item, $key) {

            $item = trim(strip_tags($item));

            if(empty($item)) {
        
                $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs.';

                $view = new View();
                $view->redirect('connection');
            }
        });

        $memberManager = new MemberManager();
        $allNickNames = $memberManager->getAllNickNames();
        $allMails = $memberManager->getAllMails();

        // Check if nickname already exists
        $nickNameResult = array_search($params['nickName'], $allNickNames);

        // Check if mail already exists
        $mailResult = array_search($params['mail'], $allMails);

        if ($nickNameResult) {
     
            $_SESSION['errorMessage'] = 'Le pseudo existe déjà.';

            $view = new View();
            $view->redirect('connection');

        } 
        
        if ($mailResult) {
            
            $_SESSION['errorMessage'] = 'Le mail existe déjà.';

            $view = new View();
            $view->redirect('connection');
        }

        // Check password confirmation
        if ($params['password'] != $params['confirmationPassword']) {

            $_SESSION['errorMessage'] = 'Le mot de passe n\'a pas été validé.';

            $view = new View();
            $view->redirect('connection');
        }

        var_dump(isset($_SESSION['errorMessage']));

        $cryptedPassword = password_hash($params['password'], PASSWORD_DEFAULT);
        
        $lastInsertId = $memberManager->addMember($params, $cryptedPassword);

        if (!$lastInsertId) {
            $_SESSION['errorMessage'] = 'Impossible d\'enregistrer le membre.';

            $view = new View();
            $view->redirect('connection');
        }

        // echo debug_print_backtrace();die;

        $_SESSION['valid'] = true;
        
        $member = $memberManager->getMember($params['mail']);

        $_SESSION['currentMember'] = $member;

        $_SESSION['actionMessage'] = 'Vous êtes connecté !';

        $view = new View();
        $view->redirect('home');
    }

    /**
     * Allows to update members informations
     * 
     * @param array $params
     */
    public function updateInfosMember($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;

        $emptyParam = false;

        array_walk($params, function(&$item, $key) {

            $item = trim(strip_tags($item));
  
            if(empty($item)) {

                $emptyParam = true;

            }
        });
var_dump($emptyParam);
        if ($emptyParam) {

            $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs.';

            $view = new View();
            $view->redirect('memberEdit/id/' . $params['member_id']);
        }
    }
 }