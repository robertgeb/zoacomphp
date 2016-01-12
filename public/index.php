<?php
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(dirname(__FILE__)));

    $url = (empty($_GET['url'])) ? '/index/index' : $_GET['url'];

    require_once (ROOT . DS . 'app' . DS . 'lib' . DS . 'init.php');

    //  Acertando as rotas
    Router::route("(\w+)/(\w+)/?(\w+)?", function($arg1, $arg2, $arg3='')
    {
        echo "Sua tentativa falhou, paspalho.";
    });
    Router::route("/index/index", function($action0, $action1, $action2 = '')
    {
        $action0 = ucfirst(strtolower($controller));
        $model = new $action0();
        $controller = $action0."Controller";
        $controller = new $controller($model);
    });
    Router::execute($url);
