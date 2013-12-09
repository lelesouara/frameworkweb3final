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
        
    }

    public function edit() {
        
    }

}
