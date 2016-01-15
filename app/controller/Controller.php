<?php
class Controller {

    protected $_model;
    protected $_action;

    function __construct($model, $action) {

        $this->_action = $action;
        $this->_model = $model;
        if (empty($this->_action) || !method_exists($this, strtolower($this->_action))) {
            throw new Exception("Parametros não compreendidos", 07);
            return false;
        }
        return true;
    }

    public function ultimas($alvo = '')
    {
        try {
            $this->_model->sync();
        } catch (Throwable $t) {
            return $t;
        }

    }
}
