<?php
class Controller {

    protected $_model;
    protected $_action;

    function __construct($model, $action) {

        $this->_action = $action;
        $this->_model = $model;
        if (empty($this->_action) || !method_exists($this->_action)) {
            return;
        }else {
            try {
                $this->_action();
            } catch (Exception $e) {
                echo "Erro sinixtro" . $e;
            }
        }
    }
}
