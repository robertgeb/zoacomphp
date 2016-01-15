<?php
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(dirname(__FILE__)));

    $url = (empty($_GET['url'])) ? 'index' : $_GET['url'];

    require_once (ROOT . DS . 'app' . DS . 'lib' . DS . 'init.php');

    //  Criando as rotas dinamicamente

    Router::route("/(\w+)/?(\w+)?/?(\w+)?", function($param0, $param1 = '', $param2 = '')
    {
        $params = func_get_args();
        $modelName = ucwords(strtolower($params[0]));

        try {
            $model = new $modelName();
            $controller = new Controller($model, $params[1]);
            $controller->{$params[1]}();
        }catch (Throwable $t){
            // echo $t->getMessage();
            // var_dump($params);
        }
        $view = new View($model, "base");
        $view->render();
        return;
    });

    try {
        Router::execute("/".$url);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
