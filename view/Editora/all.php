<a href='index.php?mod=Editora&page=add'> Cadastrar Editora </a>
<br>
<?php

foreach ($editoras as $editora){
    echo $editora->getNome()."<br>";
}