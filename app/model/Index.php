<?php
    /**
     * Classe index
     */
    class Index
    {
        private $data = array();
        function __construct()
        {
            $this->data["title"] = "Hi, im Jim.";
            $this->data["content"] = "I'm a pseudo-robo by Robert";
        }

        public function getContent()
        {
            return $this->data;
        }
    }
