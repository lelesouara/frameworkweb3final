<?php

abstract class Db {

    protected $host = DB_HOST;
    protected $user = DB_USER;
    protected $pass = DB_PASS;
    protected $dbname = DB_NAME;
    protected $dbh;     //Database Handler.
    protected $stmt;    //Statement
    protected $error;
    protected $query = "";

    /**
     * @see: Method abastract for connection.
     */
    abstract protected function conectar();

    /**
     * @see: Prepare a query with DBH.
     * @param type $query
     */
    public function query($query) {
        $this->query = $query;
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * @see: Select a type and bind a value.
     * @param type $param
     * @param type $value
     * @param type $type
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * @see Execute a method of stmt->execute();
     * @return Results
     */
    public function execute() {
        try {
            return $this->stmt->execute();
        } catch (PDOException $pdoE) {
            $this->error = $pdoE->getMessage();
            $log = fopen('log_error.txt', 'a+');
            fwrite($log, $this->error . "\r\n");
            fclose($log);
        }
    }

    /**
     * @see
     * @param type $className
     * @return Results
     */
    public function getResults($className = null) {
        $this->execute();
        if ($className) {
            return $this->stmt->fetchAll(PDO::FETCH_CLASS, "$className");
        }
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * 
     * @param type $className
     * @return row of database
     */
    public function getRow($className = null) {
        if ($className) {
            $this->stmt->setFetchMode(PDO::FETCH_CLASS, "$className");
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_CLASS);
        }
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * 
     * @return numbers of rows
     */
    public function rowCount() {
        return $this->stmt->rowCount();
    }

    /**
     * 
     * @return lastID
     */
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    /**
     * 
     * @return type
     */
    public function beginTransaction() {
        return $this->dbh->beginTransaction();
    }

    /**
     * 
     * @return type
     */
    public function endTransaction() {
        return $this->dbh->commit();
    }

    /**
     * 
     * @return type
     */
    public function cancelTransaction() {
        return $this->dbh->rollBack();
    }

}

?>
