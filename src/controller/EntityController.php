<?php

namespace App\Controller;

use App\Model\DeveloperManager;
use App\Model\PublisherManager;
use App\Model\GenreManager;
use App\Model\ModeManager;
use App\Model\PlatformManager;
use App\Model\RegionManager;
use App\Model\Pagination;
use App\Controller\ConnectionController;
use App\Core\View;

/**
 *  EntityController
 * 
 *  Allows to show, add, update and delete entities (developers, publishers, regions, modes, platforms and genres)
 */

 class EntityController
 {
    /**
     * Allows to show the entities management page
     * 
     * @param array $params optionnal
     */
    public function showEntitiesManagement($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            switch ($params['entity']) {
                case 'developer':
                    $manager = new DeveloperManager();
                    $entity = 'developer';
                    $entityFr = 'développeur';
                    break;
                case 'publisher':
                    $manager = new PublisherManager();
                    $entity = 'publisher';
                    $entityFr = 'éditeur';
                    break;
                case 'genre':
                    $manager = new GenreManager();
                    $entity = 'genre';
                    $entityFr = 'genre';
                    break;
                case 'mode':
                    $manager = new ModeManager();
                    $entity = 'mode';
                    $entityFr = 'mode';
                    break;
                case 'platform':
                    $manager = new PlatformManager();
                    $entity = 'platform';
                    $entityFr = 'platforme';
                    break;
                case 'region':
                    $manager = new RegionManager();
                    $entity = 'region';
                    $entityFr = 'région';
                    break;
            }

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            }

            $currentMember = null;

            if (isset($_SESSION['currentMember'])) {
                $currentMember = $_SESSION['currentMember'];
            }

            $totalNbRows = $manager->count();
            $url = HOST . 'entity-management/entity/' . $entity;

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 3);

            // if descendant order wanted, set $desc on true
            $desc = false;

            // set the name of element you want the list ordered by 
            $orderBy = 'name';

            $entities = $manager->getAll($orderBy, $desc, $pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $renderPagination = false;

            if ($pagination->getEnoughEntries()) {
                $renderPagination = true;
            }

            $urlAddEntity = HOST . 'add-entity/entity/' . $entity;
            $urlUpdateEntity = HOST . 'update-entity/entity/' . $entity;
            $urlDeleteEntity = HOST . 'delete-entity/entity/' . $entity;

            $view = new View('entityManagement');
            $view->render('back', array(
                'entities' => $entities,
                'entityFr' => $entityFr, 
                'pagination' => $pagination,
                'renderPagination' => $renderPagination,
                'urlAddEntity' => $urlAddEntity,
                'urlUpdateEntity' => $urlUpdateEntity,
                'urlDeleteEntity' => $urlDeleteEntity,
                'isSessionValid' => ConnectionController::isSessionValid(),
                'member' => $currentMember));

            unset($_SESSION['actionDone']);

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }


    /**
     *  Allows to add an entity
     * 
     *  @param array $params 
     */
    public function addEntity($params)
    {
        $params['name'] = trim(strip_tags($params['name']));

        if (!empty($params['name'])) {

            switch ($params['entity']) {
                case 'developer':
                    $manager = new DeveloperManager();
                    $entity = 'developer';
                    break;
                case 'publisher':
                    $manager = new PublisherManager();
                    $entity = 'publisher';
                    break;
                case 'genre':
                    $manager = new GenreManager();
                    $entity = 'genre';
                    break;
                case 'mode':
                    $manager = new ModeManager();
                    $entity = 'mode';
                    break;
                case 'platform':
                    $manager = new PlatformManager();
                    $entity = 'platform';
                    break;
                case 'region':
                    $manager = new RegionManager();
                    $entity = 'region';
                    break;
            }

            $lastInsertedId = $manager->insertEntity($params);

            $_SESSION['actionDone'] = 'Un nouvel élément a été ajouté.';

            $urlUpdateEntity = HOST . 'update-entity/entity/' . $entity . '/id/' . $lastInsertedId;
            $urlDeleteEntity = HOST . 'delete-entity/entity/' . $entity . '/id/' . $lastInsertedId;

            echo json_encode(['success' => 1, 'name' => $params['name'], 'urlUpdateEntity' => $urlUpdateEntity, 'urlDeleteEntity' => $urlDeleteEntity]);

        } else {

            $_SESSION['errorMessage'] = 'Le champs doit être renseigné.';

            echo json_encode(['success' => 0]);

        }
    }

    /**
     *  Allows to update an entity
     * 
     *  @param array $params 
     */
    public function updateEntity($params)
    {
        $params['name'] = trim(strip_tags($params['name']));

        if (!empty($params['name'])) {

            switch ($params['entity']) {
                case 'developer':
                    $manager = new DeveloperManager();
                    $entity = 'developer';
                    break;
                case 'publisher':
                    $manager = new PublisherManager();
                    $entity = 'publisher';
                    break;
                case 'genre':
                    $manager = new GenreManager();
                    $entity = 'genre';
                    break;
                case 'mode':
                    $manager = new ModeManager();
                    $entity = 'mode';
                    break;
                case 'platform':
                    $manager = new PlatformManager();
                    $entity = 'platform';
                    break;
                case 'region':
                    $manager = new RegionManager();
                    $entity = 'region';
                    break;
            }

            $manager->updateEntity($params);

            $_SESSION['actionDone'] = 'L\'élément a été mis à jour.';

            echo json_encode(['success' => 1, 'name' => $params['name']]);

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez enregistrer un champ vide.';

            echo json_encode(['success' => 0]);

        }
    }

    /**
     *  Allows to delete an entity
     * 
     *  @param array $params 
     */
    public function deleteEntity($params)
    {
        // var_dump($params);die;
        switch ($params['entity']) {
            case 'developer':
                $manager = new DeveloperManager();
                $entity = 'developer';
                break;
            case 'publisher':
                $manager = new PublisherManager();
                $entity = 'publisher';
                break;
            case 'genre':
                $manager = new GenreManager();
                $entity = 'genre';
                break;
            case 'mode':
                $manager = new ModeManager();
                $entity = 'mode';
                break;
            case 'platform':
                $manager = new PlatformManager();
                $entity = 'platform';
                break;
            case 'region':
                $manager = new RegionManager();
                $entity = 'region';
                break;
        }

        $count = $manager->deleteEntity($params);

        if(!empty($count)) {

            $_SESSION['actionDone'] = 'Un élément a été effacé.';

             echo json_encode(['success' => 1]);

        } else {

            $_SESSION['errorMessage'] = 'L\'élément n\'a pu être effacé.';

             echo json_encode(['success' => 0]);

        }  

    }

 }