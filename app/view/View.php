<?php

class View
{
    protected $_template;
    protected $_data = array();

    public function __construct($model, $template)
    {
        $this->_template = $template;
        try {
            $this->_data = $model->getContent();
        } catch (Throwable $e) {
            $this->_data['title'] = "Mistakes were made";
            $this->_data['content'] = "Juro que tentei, mas não te compreendi.";
        }
    }

    public function concatenar($modo = 0)
    {
        switch ($modo) {
            
            default:
            case 0:
                $output['title'] = "<h1>" . $this->_data["title"] . "</h1>";
                $output['type'] = gettype($this->_data["content"]);
                switch ($output['type']) {
                    case 'string':
                        $output['content'] = "<h4>"
                            . $this->_data["content"]
                            . "</h4>";
                        break;
                    case 'array':
                        $output['content'] = "<ol>";
                        foreach ($this->_data["content"] as $i => $item) {
                            $output['content'] .= "<li>"
                                . $item
                                . "</li>";
                        }
                        $output['content'] .= "</ol>";
                        break;
                    default:
                        $output['content'] = "Algo inesperado ocorreu!";
                        break;
                }
                # code...
                break;
        }

        return $output;
    }

    public function render()
    {
        $templatePath = ROOT . DS . "app" . DS . "template" . DS . $this->_template . ".php";

        $output = $this->concatenar();

        /*
        *   Comprimindo e condensando html, css e js
        */
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
