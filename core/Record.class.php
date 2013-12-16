<?php
// ACTIVE RECORD
class Record {

	// persistencia dos dados do modelo
	public function save(){
		$db = new MysqlDB();
		$pk = $this::PK;
		$table = $this::TABLE;
		$atts = array();
		if(empty($this->$pk)){	 // INSERT		
			// INSERT INTO ???? (cod , nome) VALUES (:cod ,:nome)";
			foreach($this as $key => $value){
				$atts[$key] = $value;
			}
			$q = "INSERT INTO $table (".implode(',' , array_keys($atts)).") VALUES (:".implode(',:' , array_keys($atts)).")";
			$db->query($q);
			foreach($atts as $key => $value){
				$db->bind(':'.$key, $value);
			}
			$result = $db->execute();
			$id = $db->lastInsertId();
			$this->$pk = $id;
			return $result;
		}
		else { // UPDATE tabela SET att1=:att1, att2=:att2 WHERE cod
			foreach($this as $key => $value){
				$atts[$key] = $value;
				$fields[] = $key. '=:'.$key;
			}
			$q = "UPDATE $table SET ".implode(',', $fields);
			$q .= " WHERE $pk = :$pk";
			$db->query($q);
			foreach($atts as $key => $value){
				$db->bind(':'.$key, $value);
			}
			return $db->execute();
		}	
	}

	// carregar uma linha da tabela para uma instancia do modelo
	protected function load($id){
		$db = new MysqlDB();
		$pk = $this::PK;
		$table = $this::TABLE;
		$q = "SELECT * FROM $table WHERE $pk = :".$pk;
		$db->query($q);
		$db->bind(':'.$pk, $id);
		$data = $db->getRow(get_class($this));
		if(empty($data))
			return false;
		foreach($this as $key => $value){
			$this->$key = $data->$key;
		}
	}
	
	// deleta uma linha da tabela a partir de uma instancia do modelo
	public function delete(){
		$db = new MysqlDB();
		$pk = $this::PK; 
		$table = $this::TABLE;
		$id = $this->$pk;
		$db->query("DELETE FROM $table WHERE $pk = :id");
		$db->bind(':id', $id);
		return $db->execute();		
	}
	
	public static function getList( Criteria $criteria = NULL ){
		$db = new MysqlDB();
		$class = get_called_class();
		$table = $class::TABLE;
		$q = "SELECT * FROM $table";
		if(empty($criteria)){
			$db->query($q);
			return $db->getResults($class);
		}
		
		if($criteria->getConditions()){
			$conditions = array();
			foreach($criteria->getConditions() as $c){
				$conditions[] = $c[0].' '.$c[1].' :'.$c[0];
			}
			$q .= ' WHERE '.implode(' AND ', $conditions);
		}
		
		if($criteria->getOrder())
			$q .= ' ORDER BY '.$criteria->getOrder();
			
		if($criteria->getLimit())
			$q .= ' LIMIT '.$criteria->getLimit();
			
		$db->query($q);
		foreach($criteria->getConditions() as $c){
			$db->bind(':'.$c[0], $c[2]);
		}
		return $db->getResults($class);
	} // fim do metodo getList

} // fim da classe

