<?php 

namespace App\Controller;

use App\Model\GameManager;
use App\Model\Pagination;
use App\Core\View;
use App\Controller\ConnectionController;

/**
 * HomeController
 * 
 * Allows to show the home
 */

class HomeController
{
    /**
     * Allows to show the home
     * 
     * @param array $params optionnal
     */
    public function showHome($params = [])
    {   
        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        } 

        $currentMember = null;

        if (isset($_SESSION['currentMember'])) {
            $currentMember = $_SESSION['currentMember'];
        }
        
        $gameManager = new GameManager();

        $totalNbRows = $gameManager->count();
        $url = HOST . 'home';

        $pagination = new Pagination($pageNb, $totalNbRows, $url, 5);

        // if descendant order wanted, set $desc on true
        $desc = true;

        // set the name of element you want the list ordered by 
        $orderBy = 'id';
        
        $games = $gameManager->getAll($orderBy, $desc, $pagination->getFirstEntry(), $pagination->getElementNbByPage());

        $renderPagination = false;

        if ($pagination->getEnoughEntries()) {
            $renderPagination = true;
        }

        $view = new View('home');
        $view->render('front', array(
            'games' => $games,
            'pagination' => $pagination,
            'renderPagination' => $renderPagination,
            'connected' => ConnectionController::isSessionValid(),
            'member' => $currentMember));

    }
}


