<?php

namespace App\Core;



/**
 *  View
 * 
 *  Display view and template
 */

class View
{
    /**
     * @var string the view defined by the controller
     */
    protected $_view;

    /**
     * @var string the template defined by the controller
     */
    protected $_template;

    /**
     * Set the view defined by the controller in the attribute _view
     * 
     * @param string $view optional
     */
    public function __construct($view = null)
    {
        $this->_view = $view;
    }

    /**
     * Render view and template
     * 
     * @param string $template
     * @param array $params
     */
    public function render($template, $params = [])
    {
        // foreach ($params as $name => $value) {
        //     ${name} = $value;

        // extract($params); 
        // Allows to extract variables from array's keys
        // Ex : from HomeController, allows to extract variables $games, $pagination, $isSessionValid, $actionDone

        $this->_template = $template;

        $view = $this->_view;

        // Default 
        $errorMessage = null;
        $actionMessage = null;

        // ckeck if error message
        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
        }

        // ckeck if action message
        if (isset($_SESSION['actionMessage'])) {
            $actionMessage = $_SESSION['actionMessage'];
        }

        // Load Twig
        $loader = new \Twig\Loader\FilesystemLoader([
            dirname(dirname(__DIR__)) . '/view/frontend', 
            dirname(dirname(__DIR__)) . '/view/backend', 
            dirname(dirname(__DIR__)) . '/view/templates'
        ]);

        $twig = new \Twig\Environment($loader, [
                'cache' => dirname(dirname(__DIR__)) . '/view/templates/cache', 
                'debug' => true, 
                'auto-reload' => true
        ]);

        $params['HOST'] = HOST;
        $params['ASSETS'] = ASSETS;
        $params['VENDOR'] = VENDOR;
        $params['IMAGE'] = IMAGE;
        $params['errorMessage'] = $errorMessage;
        $params['actionMessage'] = $actionMessage;

        $_SESSION['savedParams'] = $params;

        // echo "<pre>";
        // print_r($_SESSION['savedParams']);
        // echo "</pre>";die;
        echo $twig->render($view . '.twig', $params);

        unset($_SESSION['errorMessage']);
        unset($_SESSION['actionMessage']);
  
    }

    /**
     * Redirect on the page defined by the route
     * 
     * @param string $route
     */
    public function redirect($route)
    {
        header('location: ' . HOST . $route);
        exit;
    }
}