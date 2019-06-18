<?php

namespace App\Controller;

use App\Model\DeveloperManager;
use App\Model\PublisherManager;
use App\Model\GenreManager;
use App\Model\ModeManager;
use App\Model\PlatformManager;
use App\Model\RegionManager;
// use App\Model\Pagination;
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

            $data = $manager->getAll();

            $urlAddEntity = HOST . 'add-entity/entity/' . $entity;
            $urlUpdateEntity = HOST . 'update-entity/entity/' . $entity;
            $urlDeleteEntity = HOST . 'delete-entity/entity/' . $entity;

            $view = new View('entityManagement');
            $view->render('back', array(
                'entities' => $data,
                'entityFr' => $entityFr, 
                'urlAddEntity' => $urlAddEntity,
                'urlUpdateEntity' => $urlUpdateEntity,
                'urlDeleteEntity' => $urlDeleteEntity,
                'isSessionValid' => ConnectionController::isSessionValid()));

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

            $lastInsertedId = $manager->insertName($params);

            $_SESSION['actionDone'] = 'Un nouvel article a été ajouté.';

            $urlUpdateEntity = HOST . 'update-entity/entity/' . $entity . '/id/' . $lastInsertedId;
            $urlDeleteEntity = HOST . 'delete-entity/entity/' . $entity . '/id/' . $lastInsertedId;

            echo json_encode(['success' => 1, 'name' => $params['name'], 'urlUpdateEntity' => $urlUpdateEntity, 'urlDeleteEntity' => $urlDeleteEntity]);

        } else {

            $_SESSION['errorMessage'] = 'Tous les champs doivent être renseignés.';

            echo json_encode(['success' => 0]);

        }
    }
 }