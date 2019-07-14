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

        // Members can not access the member management page
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

        // if descendant order wanted, set 'DESC' 
        // if not set ''
        $desc = '';

        // set the name of element you want the list ordered by 
        $orderBy = 'nick_name';

        // type of member displayed, all by default
        $displayedMembers = ' WHERE id_type = 3 OR id_type = 2';

        if (isset($params['displayedMembers'])) {
            if ($params['displayedMembers'] == 'members') {
                $displayedMembers = ' WHERE id_type = 3';
            } else if ($params['displayedMembers'] == 'moderators') {
                $displayedMembers = ' WHERE id_type = 2';
            }
        }

        $members = $memberManager->getAll(' ORDER BY nick_name', ' ', 'LIMIT ' . $pagination->getFirstEntry() . ',', $pagination->getElementNbByPage(), $displayedMembers);

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

        $_SESSION['actionDone'] = 'Bienvenue parmis nous ' . $member->getNick_name() . ' !';

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
            $memberManager->updateInfosMember($params);

            $db->commit();

        } catch (\Exception $e) {

            $db->rollBack();

            $_SESSION['errorMessage'] = $e->getMessage();;

            $view = new View();
            $view->redirect('infos-member/id/' . $params['member_id']);
        }

        $_SESSION['actionDone'] = 'Vos informations ont bien été modifiées.';

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

        $_SESSION['actionDone'] = 'Votre mot de passe a bien été modifié.';

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
            $_SESSION['actionDone'] = 'Le statut du membre a bien été modifié.';
        }

        $cancelModeratorAsk = true;
        // Set 'becoming moderator' on false in member column
        $memberManager->updateBecomingModerator($member_id, $cancelModeratorAsk);

        if (isset($params['page']) && $params['page'] == 'requestsModerators') {
            $view = new View();
            $view->redirect('requests-moderators');
        } else {
            $view = new View();
            $view->redirect('member-management');
        }
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
            $_SESSION['actionDone'] = 'Le compte a bien été supprimé.';

            $view = new View();
            $view->redirect('member-management');
        }

        $_SESSION['actionDone'] = 'Votre compte a bien été supprimé.';

        unset($_SESSION['valid']);
        unset($_SESSION['currentMember']);

        $view = new View();
        $view->redirect('home');
    }

    /**
     * Allows to set the 'becoming moderator' column on true in a member
     */
    public function askBecomingModerator($params = [])
    {
        // echo "<pre>";
        // print_r($params);
        // echo "</pre>";die;

        extract($params); // Allows to extract the $id variable

        $member_id = $id;

        if (isset($params['moderatorAsk']) && $params['moderatorAsk'] == 'cancel') {

            $cancelModeratorAsk = true;

            $memberManager = new MemberManager();
            $askedBecomingModerator = $memberManager->updateBecomingModerator($member_id, $cancelModeratorAsk);

            if (!$askedBecomingModerator) {
                throw new \Exception('Impossible d\'annuler la demande.');
            }

            $_SESSION['actionDone'] = 'La demande d\'annulation a bien été prise en compte.';

        } else {
            $memberManager = new MemberManager();
            $askedBecomingModerator = $memberManager->updateBecomingModerator($member_id);

            if (!$askedBecomingModerator) {
                throw new \Exception('Impossible de faire la demande.');
            }
    
            $_SESSION['actionDone'] = 'La demande a bien été prise en compte.';
        }

        $view = new View();
        $view->redirect('infos-member/id/' . $member_id);
    }

    /**
     * Allows to show members request to be moderator
     */
    public function showRequestsToBeModerator($params = [])
    {
        $currentMember = null;

        if (isset($_SESSION['currentMember'])) {
            $currentMember = $_SESSION['currentMember'];
        }

        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        }

        $memberManager = new MemberManager();

        $totalNbRows = $memberManager->countMembersRequestingToBeModerator();
        $url = HOST . 'requests-moderators';

        $pagination = new Pagination($pageNb, $totalNbRows, $url, 15);

        $membersRequests = $memberManager->getMembersRequestingToBeModerator($pagination->getFirstEntry(), $pagination->getElementNbByPage());

        if (!$membersRequests) {
            throw new \Exception('Impossible de récupérer les membres souhaitant être modérateurs.');
        }

        $renderPagination = false;

        if ($pagination->getEnoughEntries()) {
            $renderPagination = true;
        }

        $view = new View('requestsModerators');
        $view->render('back', array(
            'membersRequests' => $membersRequests,
            'pagination' => $pagination,
            'renderPagination' => $renderPagination,
            'isSessionValid' => ConnectionController::isSessionValid(),
            'member' => $currentMember
        ));
    }

    /**
     * Allows to cancel becoming moderator's ask
     */
    public function refuseModeratorStatus($params = [])
    {
        extract($params); // Allows to extract the $id variable

        $member_id = $id;

        $cancelModeratorAsk = true;

        $memberManager = new MemberManager();
        $result = $memberManager->updateBecomingModerator($member_id, $cancelModeratorAsk);

        if (!$result) {
            throw new \Exception('Impossible d\'annuler la demande.');
        }

        $_SESSION['actionDone'] = 'La demande de refus a bien été prise en compte.';

        $view = new View();
        $view->redirect('requests-moderators');

    }
 }