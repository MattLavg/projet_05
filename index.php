<?php

use App\Core\Routeur;
use App\core\Registry;
use App\Core\MyException;

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'errorHandler.php';
require_once CORE . 'MyException.php';

// Load Twig
// $loader = new \Twig\Loader\FilesystemLoader(['view/frontend', 'view/backend']);
// $twig = new \Twig\Environment($loader, [
//     'cache' => 'view/templates/cache', 'debug' => true, 'auto-reload' => true
// ]);var_dump($twig);die;


// $db = new \PDO('mysql:host=localhost;dbname=projet04;charset=utf8', 'root', 'root');

// function getPost($id, $db)
//     { 

//         $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updateDate FROM posts WHERE id = ?');
//         $req->execute(array($id));

//         $data = $req->fetch(\PDO::FETCH_ASSOC);

//         return $data;
//     }

// $result = getPost(53, $db);

// $template = $twig->load('vue.html');
// echo $template->render(['result' => $result]);

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