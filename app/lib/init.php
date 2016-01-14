<?php

//Carrega as constantes de configuracoes iniciais

require_once (ROOT . DS . 'app' . DS . 'config.php');

/** Verifica se ambiente de desenvolvimento e mostra erros **/

function setReporting()
{
if (DEVELOPMENT_ENVIRONMENT == true) {
    error_reporting(E_ALL);
    ini_set('display_errors','On');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors','Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}

/** Checa por globals registradas e remove **/

function unregisterGlobals()
{
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Procura toda classe carregada nos diretorios corretos **/

function __autoload($className) {
    if (file_exists(ROOT . DS . 'app' . DS . 'lib' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'lib' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'controller' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controller' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'model' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'model' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'view' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'view' . DS . $className . '.php');
    } else {
        /* Error Generation Code Here */
    }
}

setReporting();
unregisterGlobals();
