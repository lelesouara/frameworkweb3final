<?php

final class MysqlDB extends Db {

    /**
     * @see Construct Object
     */
    function __construct() {
        $this->conectar();
    }

    /**
     * @see Method extended of father class.
     */
    protected function conectar() {
        //Database Source Name;
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //Set Options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //Create a new PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $exc) {
            $this->error = $exc->getMessage();
            $log = fopen('log_error.txt', 'a+');
            fwrite($log, $this->error . "\r\n");
            fclose($log);
        }
    }

}

?>
