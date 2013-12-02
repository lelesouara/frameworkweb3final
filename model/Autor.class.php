<?php

    class Autor extends Record{
        
        const TABLE = "autor";
        const PK = "cod";
        
        protected $cod;
        protected $nome;
        protected $pais;
        
        function __construct($id = null) {
            if(!is_null($id)){
                $this->load($id);
            }
        }
        
        public function getCod() {
            return $this->cod;
        }

        public function setCod($cod) {
            $this->cod = $cod;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getPais() {
            return $this->pais;
        }

        public function setPais($pais) {
            $this->pais = $pais;
        }
        
    }
?>
