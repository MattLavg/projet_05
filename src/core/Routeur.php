<?php

namespace App\Core;

use App\Core\View;
use App\Core\MyException;

/**
 *  Routeur
 * 
 *  Create routes and find controller
 */

class Routeur
{
    /**
     * @var string the user request
     */
    protected $_request;

    /**
     * @var array routes declaration
     * 
     * Use of full namespace because php does not find the file with dynamic writing
     */
    protected $_routes = [ 
        'home'                    => ['controller' => 'App\Controller\HomeController',       'method' => 'showHome'],
        'game'                    => ['controller' => 'App\Controller\GameController',       'method' => 'showGame'],
        'connection'              => ['controller' => 'App\Controller\ConnectionController', 'method' => 'showConnection'],
        'login'                   => ['controller' => 'App\Controller\ConnectionController', 'method' => 'loginCheck'],
        'logout'                  => ['controller' => 'App\Controller\ConnectionController', 'method' => 'logOut'],
        'edit-game'               => ['controller' => 'App\Controller\GameController',       'method' => 'showEditGame'],
        'add-game'                => ['controller' => 'App\Controller\GameController',       'method' => 'addGame'],
        'update-game'             => ['controller' => 'App\Controller\GameController',       'method' => 'updateGame'],
        'delete-game'             => ['controller' => 'App\Controller\GameController',       'method' => 'deleteGameAndComments'],
        'game-management'         => ['controller' => 'App\Controller\GameController',       'method' => 'showGamesManagement'],
        'entity-management'       => ['controller' => 'App\Controller\EntityController',     'method' => 'showEntitiesManagement'],
        'add-entity'              => ['controller' => 'App\Controller\EntityController',     'method' => 'addEntity'],
        'update-entity'           => ['controller' => 'App\Controller\EntityController',     'method' => 'updateEntity'],
        'delete-entity'           => ['controller' => 'App\Controller\EntityController',     'method' => 'deleteEntity'],
        'add-member'              => ['controller' => 'App\Controller\MemberController',     'method' => 'addMember'],
        'infos-member'            => ['controller' => 'App\Controller\MemberController',     'method' => 'showInformationsMember'],
        'edit-infos-member'       => ['controller' => 'App\Controller\MemberController',     'method' => 'showEditMember'],
        'update-infos-member'     => ['controller' => 'App\Controller\MemberController',     'method' => 'updateInfosMember'],
        'update-password-member'  => ['controller' => 'App\Controller\MemberController',     'method' => 'updatePasswordMember'],
        'update-status-member'    => ['controller' => 'App\Controller\MemberController',     'method' => 'updateStatusMember'],
        'delete-member'           => ['controller' => 'App\Controller\MemberController',     'method' => 'deleteMember'],
        'ask-becoming-moderator'  => ['controller' => 'App\Controller\MemberController',     'method' => 'askBecomingModerator'],
        'requests-moderators'     => ['controller' => 'App\Controller\MemberController',     'method' => 'showRequestsToBeModerator'],
        'refuse-moderator-status' => ['controller' => 'App\Controller\MemberController',     'method' => 'refuseModeratorStatus'],
        'member-management'       => ['controller' => 'App\Controller\MemberController',     'method' => 'showMemberManagement'],
        'reported-comments'       => ['controller' => 'App\Controller\CommentController',    'method' => 'showReportedComments'],
        'add-comment'             => ['controller' => 'App\Controller\CommentController',    'method' => 'addComment'],
        'delete-comment'          => ['controller' => 'App\Controller\CommentController',    'method' => 'deleteComment'],
        'report-comment'          => ['controller' => 'App\Controller\CommentController',    'method' => 'reportComment'],
        'valid-comment'           => ['controller' => 'App\Controller\CommentController',    'method' => 'validComment'],
        'search-game'             => ['controller' => 'App\Controller\SearchController',     'method' => 'searchGame'],
        'error'                   => ['controller' => 'App\Controller\ErrorController',      'method' => 'showError']
    ];

    /**
     * Get user request
     * 
     * @param string $request, the user request
     */
    public function __construct($request)
    {
        $this->_request = $request;
    }

    /**
     * Get route
     * 
     * @return string the first element of the array
     */
    public function getRoute()
    {
        $elements = explode('/', $this->_request);
        return $elements[0];
    }

    /**
     * Get "get" or "post" parameters
     * 
     * @return array with get or post parameters
     */
    public function getParams()
    {
        $params = [];
        
        // GET 
        $elements = explode('/', $this->_request); 
        unset($elements[0]);

        for ($i = 1; $i < count($elements); $i++) {
            $params[$elements[$i]] = $elements[$i + 1];
            $i++; // Add another one if more
        }

        // POST
        if ($_POST) {

            foreach ($_POST as $key => $value) {
                $params[$key] = $value;
            }

        }

        return $params;
    }

    /**
     * Get the controller defined by the route with the method defined by the params
     */
    public function renderController()
    {
        $route = $this->getRoute();
        $params = $this->getParams();

        if (key_exists($route, $this->_routes)) {

            $controller = $this->_routes[$route]['controller'];
            $method = $this->_routes[$route]['method'];

            $currentController = new $controller();
            $currentController->$method($params);

        } else {
            throw new MyException('404 : Cette page n\'existe pas.');
        }
    }
}