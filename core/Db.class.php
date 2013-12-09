<?php
abstract class Db {
	
	protected $host = DB_HOST;
	protected $user = DB_USER;
	protected $pass = DB_PASS;
	protected $dbname = DB_NAME;
	protected $dbh; // database handler
	protected $stmt; // statement
	protected $error;
	protected $query = "";
	
	// método assinatura a ser implementado pelo filho
	abstract protected function conectar();
	
	public function query($query){
		$this->query = $query;
		$this->stmt = $this->dbh->prepare($query);
	}
	
	public function bind($param, $value, $type = NULL){
		if(is_null($type)){
			switch(true){
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
			} // end switch
		} // endif
		$this->stmt->bindValue($param, $value, $type);		
	}
	
	public function execute(){
		try {
			return $this->stmt->execute();
		} catch(PDOException $p){
			$this->error = $p->getMessage();
			$log = fopen('log_db_error.txt','a+');
			fwrite($log, $this->error."\r\n");
			fclose($log);
		}
	}
	
	public function getResults($class = NULL){
		$this->execute();
		if($class){
			return $this->stmt->fetchAll(PDO::FETCH_CLASS, $class);
		}
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function getRow($class = NULL){
		if($class){
			$this->stmt->setFetchMode(PDO::FETCH_CLASS, $class);
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_CLASS);
		}
		else{
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}
	}
	
	public function rowCount(){
		return $this->stmt->rowCount();
	}	
	
	public function lastInsertId() {
		return $this->dbh->lastInsertId();
	}
	
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	public function endTransaction(){
		return $this->dbh->commit();
	}
	
	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}
	

} // fim da classe
