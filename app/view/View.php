<?php

class View
{
    protected $_template;
    protected $_data = array();

    public function __construct($model, $template)
    {
        $this->_template = $template;
        $this->_data = $model->getContent();
    }

    public function render()
    {
        $templatePath = ROOT . DS . "app" . DS . "template" . DS . $this->_template . ".php";
        $title = $this->_data["title"];
        $content = $this->_data["content"];
        function compress_html($buffer)
    	{
            $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
            $buffer = preg_replace('/<!--.*?-->/ms', '', $buffer);
            $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  '), '', $buffer);
            return $buffer;
    	}
        ob_start("compress_html");
        include ($templatePath);
        ob_end_flush();
    }

}
