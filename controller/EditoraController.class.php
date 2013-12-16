<?php

class EditoraController {

    public function all() {
        $editoras = Editora::getList();

        $view = new View("Editora", "all", "default");
        $view->editoras = $editoras;
        $view->setTitle("Todas as editoras");
        $view->render();
    }

    public function view() {
        $id = (int) $_GET['id'];
        $editoras = new Editora($id); 
        
        $view = new View("Editora", "view", "default");
        $view->livrosEditora = $editoras->getLivros();
        $view->setTitle("Visualizar Editora");
        $view->render();
    }

    public function index() {
        
    }

    public function add() {
        if (count($_POST)) {
            $nome = $_POST['nome'];
            $Editora = new Editora();
            $Editora->setNome($nome);
            $Editora->save();
            header("Location: index.php?mod=Editora&page=all");
            exit;
        }

        $view = new View("Editora", "add", "default");
        $view->setTitle("Cadastrar Editora");
        $view->render();
    }

    public function edit() {
        $editora = new Editora((int) $_GET['id']);

        if (count($_POST) > 0) {
            $nome = strip_tags($_POST['nome']);
            $cod = strip_tags($_POST['cod']);
            
            if(!is_integer($cod)){
                header("Location: index.php?mod=Editora&page=all");
                exit;
            }
            
            $Editora = new Editora();
            $Editora->setNome($nome);
            $Editora->setCod($cod);
            $Editora->save();
            header("Location: index.php?mod=Editora&page=all");
            exit;
        }

        $view = new View("Editora", "edit", "default");
        $view->setTitle("Editar Editora");
        $view->editora = $editora;
        $view->render();
    }
    
    public function delete() {
        if(count($_POST) > 0){
            
            $cod = $_POST['cod'];
            $Editora = new Editora();
            $Editora->setCod($cod);
            
            $Editora->delete();
            header("Location: index.php?mod=Editora&page=all");
            exit;
        }
    }

}
