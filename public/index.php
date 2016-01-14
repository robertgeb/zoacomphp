<?php
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(dirname(__FILE__)));

    $url = (empty($_GET['url'])) ? 'index' : $_GET['url'];

    require_once (ROOT . DS . 'app' . DS . 'lib' . DS . 'init.php');

    //  Criando as rotas dinamicamente

    Router::route("/(\w+)/?(\w+)?/?(\w+)?", function($param0, $param1='', $param2)
    {
        $params = func_get_args();
        $model = ucwords(strtolower($params[0]));
        if ($params[0] == "index") {
            $model = new Index();
            $controller = new Controller($model, $param1);
            $view = new View($model, "base");
            $view->render();
            return;
        }
        try {
            $model = $model();
        }catch (Throwable $t){
            echo "Err404";
        } catch (Exception $e) {
            echo "Err404";
            // echo $e->getMessage();
        }

    });

    try {
        Router::execute("/".$url);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
