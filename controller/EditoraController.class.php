<?php

class EditoraController {

    public function all() {
        $editoras = Editora::getList();
        
        $view = new View("Editora", "all", "default");
        $view->editoras = $editoras;
        $view->render();
    }

    public function view() {
        
    }

    public function index() {
        
    }

    public function add() {
        if(count($_POST)){
            $nome = $_POST['nome'];
            $Editora = new Editora();
            $Editora->setNome($nome);
            $Editora->save();
            header("Location: index.php?mod=Editora&page=all");
        }
        
        $view = new View("Editora", "add", "default");
        $view->setTitle("Cadastrar Editora");
        $view->render();
    }

    public function edit() {
        
    }

}
