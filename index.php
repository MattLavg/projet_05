<?php

use App\Core\Routeur;
use App\Core\Registry;
use App\Core\MyException;

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'errorHandler.php';
require_once CORE . 'MyException.php';


try
{

    try {
        $db = new \PDO( 'mysql:host='. DB_HOST .';
                        dbname='. DB_NAME .';
                        charset=utf8', 
                        DB_USER_NAME, 
                        DB_PASSWORD);
    } catch (\Exception $e) {
        throw new MyException('Impossible de se connecter à la base de donnée.');
    }

    session_start();

    Registry::setDb($db);

    // Routeur's default parameter
    if (isset($_GET['page'])) {
        $request = $_GET['page'];
    } else {
        $request = 'home';
    }

    $routeur = new Routeur($request);
    $routeur->renderController();

}
catch (MyException $e)
{
    $_SESSION['errorMessage'] = $e->getMessage();

    $myException = new MyException($e->getMessage(), $e->getCode(), $e->getSeverity(), $e->getFile(), $e->getLine());
    $myException->writeLogs();

    $routeur = new Routeur('error');
    $routeur->renderController();

}