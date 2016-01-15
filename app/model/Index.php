<?php
    /**
     * Classe index
     */
    class Index
    {
        private $data = array();
        function __construct()
        {
            $this->data["title"] = "Jim say:";
            $this->data["content"] = "Hi, im Jim, a pseudo-robo.";
        }

        public function getContent()
        {
            return $this->data;
        }
    }
