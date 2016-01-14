<?php
    /**
     * Classe Crawler de noticias
     */
    class Noticias
    {
        public $_alvos = array('estadao' => 'estadao.com.br');
        public $_manchetes = array();
        function __construct()
        {
        }

        /*
        *   Atualiza as manchetes
        */
        public function sync()
        {
            foreach ($this->_alvos as $i => $alvo) {

                /*
                *   Obtendo html
                */
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, "http://www." . $alvo);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $html = curl_exec($ch);
                if ($html === false) {
                    throw new Exception(curl_error(), 01);
                    continue;
                }
                curl_close($ch);

                /*
                *   Manipulando DOM para busca de manchetes
                */
                $dom = new DOMDocument();
                $dom->loadHTML($html);
                $xpath = new DOMXPath($dom);
                $elements = $xpath->query("//a[@href]/h2[@class='titulo']");
                $this->_manchetes[$i] = array();
                foreach ($elements as $i => $element) {
                    $this->_manchetes[$i][] = $element->nodeValue;
                }

            }
        }

        /*
        *   Retorna as manchetes
        */
        public function getHeadlines($alvo = '')
        {
            if (empty($this->_manchetes) !== false) {
                throw new Exception("Nada foi encontrado. Tente sincronizar(Noticias->sync)", 02);
                return false;
            }elseif (empty($alvo) === false && array_key_exists(strtolower($alvo), $this->_alvos) === false) {
                throw new Exception("Alvo inexistente.", 03);
                return false;
            }elseif (empty($alvo) === false && array_key_exists($alvo), $this->_manchetes) === false {
                throw new Exception("Sem manchetes para esse alvo. Tente sincronizar(Noticias->sync)", 04);
                return false;
            }elseif (empty($alvo) !== false) {
                return array_values($this->_manchetes[$alvo]);
            }else {
                return $this->_manchetes;
            }
        }
    }
