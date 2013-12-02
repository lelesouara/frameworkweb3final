<?php

    class Livroautor extends Record{
        
        const   TABLE   = "livroautor";
        const   PK      = "cod";
        
        protected $cod;
        protected $codLivro;
        protected $codAutor;
        
        private $livro;
        private $autor;
        
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
        
        public function getCodLivro() {
            return $this->codLivro;
        }

        public function setCodLivro($codLivro) {
            $this->codLivro = $codLivro;
        }

        public function getCodAutor() {
            return $this->codAutor;
        }

        public function setCodAutor($codAutor) {
            $this->codAutor = $codAutor;
        }
        
        public function getLivro() {
            if(empty($this->livro)){
                $this->livro = new Livros($this->codLivro);
            }
            return $this->livro;
        }
        
        public function getAutor(){
            if(empty($this->autor)){
                $this->autor = new Autor($this->codAutor);
            }
            return $this->autor;
        }
    }

?>
