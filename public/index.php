<?php
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(dirname(__FILE__)));

    $url = (empty($_GET['url'])) ? '/index' : $_GET['url'];

    require_once (ROOT . DS . 'app' . DS . 'lib' . DS . 'init.php');

    //  Acertando as rotas
    Router::route("(\w+)/?(\w+)?/?(\w+)?", function($arg1, $arg2, $arg3='')
    {
        echo "err 404\n $arg1/$arg2/$arg3";
    });

    Router::route("/index/?(\w)?", function($action0='Index', $action1='', $action2 = '')
    {
        $action0 = ucfirst(strtolower($action0));
        $model = new $action0();
        $controller = new Controller($model, $action1);
        $view = new View($model, "base");
        $view->render();
    });
    Router::execute($url);
