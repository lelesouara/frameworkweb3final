<?php

     /**
     * Editora Class
     */

    class Editora extends Record{
        
        const   TABLE   = "editora";
        const   PK      = "cod";
        
        //Atributos para serem mapeados
        protected $cod;
        protected $nome;
        
        //Atributos de relacionamentos
        private $livros = array();

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

        public function getLivros() {
            if(!count($this->livros)){
                $criteria = new Criteria();
                $criteria->addCondition('codEditora', '=', $this->cod);
                $this->livros = Livros::getList($criteria);
            }
            return $this->livros;
        }

        public function setLivros($livros) {
            $this->livros = $livros;
        }
    }

?>
