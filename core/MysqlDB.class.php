<?php
final class MysqlDB extends Db{
		
	function __construct(){
		$this->conectar();
	}
	
	protected function conectar(){
		// Database Source Name
		 $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
			$log = fopen('log_db_error.txt','a+');
			fwrite($log, date("d/M/Y H:i").' - '.$this->error."\r\n");
			fwrite($log, "================================================\r\n");
			fclose($log);
        }
	}
		
	
}



