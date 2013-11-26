<?php   
    include '../core/dbconfig.php';
    include '../core/Db.class.php';
    include '../core/MysqlDB.class.php';
    include '../core/Record.class.php';
    include '../model/Editora.class.php';
    
    $ed = new Editora(2);
    echo "<pre>";
    print_r($ed);
    
    //$ed->delete();
?>
