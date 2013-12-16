<?php 
class Criteria{
	private $conditions = array();
	private $limit;
	private $order;
	
	public function addCondition($field='', $op='=', $value='' ){
		$this->conditions[] = array($field, $op, $value);
	}	
	
	public function addLimit($l){
		$this->limit = $l;
	}
	
	public function addOrder($o){
		$this->order = $o;
	}
	
	public function getConditions(){
		return $this->conditions;
	}
	
	public function getLimit(){
		return $this->limit;
	}
	
	public function getOrder(){
		return $this->order;
	}	
}
?>