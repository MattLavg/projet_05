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
     * Allows to add a member
     * 
     * @param array $params
     */
    public function addMember($params = [])
    {
        echo "<pre>";
        print_r($params);
        echo "</pre>";

        // Default SESSION['valid'] to false
        $_SESSION['valid'] = false;

        // array_walk($params, function(&$item, $key) {

        //     $item = trim(strip_tags($item));

        //     if(empty($item)) {
        
        //         $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs.';

        //         $view = new View();
        //         $view->redirect('connection');
        //     }
        // });

        // $memberManager = new MemberManager();
        // $allNickNames = $memberManager->getAllNickNames();
        // $allMails = $memberManager->getAllMails();

        // echo "<pre>";
        // print_r($allNickNames);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($allMails);
        // echo "</pre>";

        // // Check if nickname already exists
        // $nickNameResult = array_search($params['nickName'], $allNickNames);

        // // Check if mail already exists
        // $mailResult = array_search($params['mail'], $allMails);

        // echo "<pre>";
        // var_dump($nickNameResult);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($mailResult);
        // echo "</pre>";

        // if ($nickNameResult) {
        //     die;
        //     $_SESSION['errorMessage'] = 'Le pseudo existe déjà.';

        //     $view = new View();
        //     $view->redirect('connection');

        // } 
        
        // if ($mailResult) {
        //     die;
        //     $_SESSION['errorMessage'] = 'Le mail existe déjà.';

        //     $view = new View();
        //     $view->redirect('connection');
        // }

        // // Check password confirmation
        // if ($params['password'] != $params['confirmationPassword']) {

        //     $_SESSION['errorMessage'] = 'Le mot de passe n\'a pas été validé.';

        //     $view = new View();
        //     $view->redirect('connection');
        // }

        // var_dump(isset($_SESSION['errorMessage']));

        $cryptedPassword = password_hash($params['password'], PASSWORD_DEFAULT);
        $memberManager = new MemberManager();
        $lastInsertId = $memberManager->addMember($params, $cryptedPassword);
var_dump($lastInsertId);die;
        if (!$lastInsertId) {
            $_SESSION['errorMessage'] = 'Impossible d\'enregistrer le membre.';

            $view = new View();
            $view->redirect('connection');
        }

        $_SESSION['valid'] = true;
        
        $member = $memberManager->getMember($params['mail']);

        $_SESSION['currentMember'] = $member;

        $_SESSION['actionMessage'] = 'Vous êtes connecté !';

        $view = new View();
        $view->redirect('home');
    }
 }