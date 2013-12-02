<?php
    class Livros extends Record{
        
        const   TABLE   = "livros";
        const   PK      = "cod";
        
        protected $cod;
        protected $titulo;
        protected $edicao;
        protected $idioma;
        protected $exemplares;
        protected $codEditora;
        
        private   $editora; // Atributo de relacionamento deve ser privado.
         
        function __construct($id = null) {
            if(!is_null($id)){
                $this->load($id);
            }
        }
        
        public function getEditora(){
            if(empty($this->editora)){
                $this->editora = new Editora($this->codEditora);
            }
            return $this->editora;
        }


        public function getCod() {
            return $this->cod;
        }

        public function setCod($cod) {
            $this->cod = $cod;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        public function getEdicao() {
            return $this->edicao;
        }

        public function setEdicao($edicao) {
            $this->edicao = $edicao;
        }

        public function getIdioma() {
            return $this->idioma;
        }

        public function setIdioma($idioma) {
            $this->idioma = $idioma;
        }

        public function getExemplares() {
            return $this->exemplares;
        }

        public function setExemplares($exemplares) {
            $this->exemplares = $exemplares;
        }

        public function getCodEditora() {
            return $this->codEditora;
        }

        public function setCodEditora($codEditora) {
            $this->codEditora = $codEditora;
        }
        
    }
?>
