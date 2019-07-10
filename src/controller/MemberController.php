<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Core\View;
use App\Core\Registry;
use App\Model\Pagination;

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

            extract($params); // Allows to extract the $id variable

            $member_id = $id;

            $memberManager = new MemberManager();
            $member = $memberManager->getMemberById($member_id);

            // update member's infos in session
            $_SESSION['currentMember'] = $member;

            $view = new View('memberInfos');
            $view->render('back', array(
                'member' => $member,
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

            extract($params); // Allows to extract the $id variable

            $member_id = $id;

            $memberManager = new MemberManager();
            $member = $memberManager->getMemberById($member_id);

            $view = new View('memberEdit');
            $view->render('back', array(
                'member' => $member,
                'connected' => ConnectionController::isSessionValid()
            ));


        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to showMemberManagement
     * 
     * @param array $params
     */
    public function showMemberManagement($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";

        $currentMember = null;

        if (isset($_SESSION['currentMember'])) {
            $currentMember = $_SESSION['currentMember'];
        }

        // Members can not access the member mangement page
        if ($currentMember->getId_type() != 1) {
            $_SESSION['errorMessage'] = 'Vous n\'avez pas les droits pour accéder à cette page.';

            $view = new View();
            $view->redirect('home');
        }

        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        }

        $memberManager = new MemberManager();

        $totalNbRows = $memberManager->count();
        $url = HOST . 'member-management';

        $pagination = new Pagination($pageNb, $totalNbRows, $url, 15);

        // if descendant order wanted, set $desc on true
        $desc = false;

        // set the name of element you want the list ordered by 
        $orderBy = 'nick_name';

        // type of member displayed, all by default
        $displayedMembers = 'all';

        if (isset($params['displayedMembers'])) {
            if ($params['displayedMembers'] == 'members') {
                $displayedMembers = 'members';
            } else if ($params['displayedMembers'] == 'moderators') {
                $displayedMembers = 'moderators';
            }
        }

        $members = $memberManager->getAllMembers($orderBy, $desc, $pagination->getFirstEntry(), $pagination->getElementNbByPage(), $displayedMembers);

        $renderPagination = false;

        if ($pagination->getEnoughEntries()) {
            $renderPagination = true;
        }

        $view = new View('memberManagement');
        $view->render('back', array(
            'members' => $members,
            'pagination' => $pagination,
            'renderPagination' => $renderPagination,
            'isSessionValid' => ConnectionController::isSessionValid(),
            'member' => $currentMember
        ));

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

        $cryptedPassword = password_hash($params['password'], PASSWORD_DEFAULT);
        
        $lastInsertId = $memberManager->addMember($params, $cryptedPassword);

        if (!$lastInsertId) {
            $_SESSION['errorMessage'] = 'Impossible d\'enregistrer le membre.';

            $view = new View();
            $view->redirect('connection');
        }

        // echo debug_print_backtrace();die;

        $_SESSION['valid'] = true;
        
        $member = $memberManager->getMemberByMail($params['mail']);

        $_SESSION['currentMember'] = $member;

        $_SESSION['actionMessage'] = 'Bienvenue parmis nous ' . $member->getNick_name() . ' !';

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

        foreach ($params as $key => &$value) {

            $value = trim(strip_tags($value));

            if (empty($value)) {

                $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs.';
    
                $view = new View();
                $view->redirect('edit-infos-member/id/' . $params['member_id']);
            }
        }

        $birthday = explode('-', $params['birthday']);

        if (!checkdate($birthday[1], $birthday[2], $birthday[0])) {

            $_SESSION['errorMessage'] = 'La date n\'est pas valide.';

            $view = new View();
            $view->redirect('edit-infos-member/id/' . $params['member_id']);
        }

        try {

            $db = Registry::getDb();
            
            $db->beginTransaction();

            $memberManager = new MemberManager();

            // Update member's informations
            $updatedMemberInfos = $memberManager->updateInfosMember($params);

            $db->commit();

        } catch (\Exception $e) {

            $db->rollBack();

            $_SESSION['errorMessage'] = $e->getMessage();;

            $view = new View();
            $view->redirect('infos-member/id/' . $params['member_id']);
        }

        $_SESSION['actionMessage'] = 'Vos informations ont bien été modifiées.';

        $view = new View();
        $view->redirect('infos-member/id/' . $params['member_id']);
        
    }

    /**
     * Allows to update members informations
     * 
     * @param array $params
     */
    public function updatePasswordMember($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;

        foreach ($params as $key => &$value) {

            $value = trim(strip_tags($value));

            if (empty($value)) {

                $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs.';
    
                $view = new View();
                $view->redirect('edit-infos-member/id/' . $params['member_id']);
            }
        }

        // Check password confirmation
        if ($params['password'] != $params['confirmationPassword']) {

            $_SESSION['errorMessage'] = 'Vous devez confirmer votre mot de passe.';

            $view = new View();
            $view->redirect('edit-infos-member/id/' . $params['member_id']);
        }

        $cryptedPassword = password_hash($params['password'], PASSWORD_DEFAULT);

        try {

            $db = Registry::getDb();
            
            $db->beginTransaction();

            $memberManager = new MemberManager();

            // Update member's informations
            $updatedMemberPassword = $memberManager->updatePasswordMember($params, $cryptedPassword);

            if (!$updatedMemberPassword) {
                throw new \Exception('Impossible de modifier le mot de passe.');
            }

            $db->commit();

        } catch (\Exception $e) {

            $db->rollBack();

            $_SESSION['errorMessage'] = $e->getMessage();;

            $view = new View();
            $view->redirect('infos-member/id/' . $params['member_id']);
        }

        $_SESSION['actionMessage'] = 'Votre mot de passe a bien été modifié.';

        $view = new View();
        $view->redirect('infos-member/id/' . $params['member_id']);
        
    }

    /**
     * Allows to update status member
     * 
     * @param array $params
     */
    public function updateStatusMember($params = [])
    {
        extract($params); // Allows to extract the $id variable

        $member_id = $id;

        $memberManager = new MemberManager();
        $member = $memberManager->getMemberByid($member_id);

        $status = null;

        if ($member->getId_type() == 3) {
            $status = 2;
        } else {
            $status = 3;
        }

        $statusUpdated = $memberManager->updateStatusMember($member_id, $status);

        if (!$statusUpdated) {
            $_SESSION['errorMessage'] = 'Impossible de modifier le statut du membre.';
        } else {
            $_SESSION['actionMessage'] = 'Le statut du membre a bien été modifié.';
        }

        $view = new View();
        $view->redirect('member-management');
    }

    /**
     * Allows to delete a member
     * 
     * @param array $params
     */
    public function deleteMember($params = [])
    {
        extract($params); // Allows to extract the $id variable

        $member_id = $id;

        $memberManager = new MemberManager();
        $deletedMember = $memberManager->deleteMember($member_id);

        if (!$deletedMember) {
            throw new \Exception('Impossible de supprimer le compte.');
        }

        if (isset($params['origin']) && $params['origin'] == "admin") {
            $_SESSION['actionMessage'] = 'Le compte a bien été supprimé.';

            $view = new View();
            $view->redirect('member-management');
        }

        $_SESSION['actionMessage'] = 'Votre compte a bien été supprimé.';

        unset($_SESSION['valid']);
        unset($_SESSION['currentMember']);

        $view = new View();
        $view->redirect('home');
    }
 }