<?php
    /**
     * Active Record classe.
     */

    class Record{
        
        /**
         * @OBS Carrega uma linha da tabela para o modelo.
         * @param integer $id
         * @return miced
         */
        protected function load($id){
            $db     = new MysqlDB();
            $pk     = $this::PK;
            $table  = $this::TABLE;
            
            //Instrução SQL
            $sql = "SELECT * FROM $table WHERE $pk = :".$pk;
            $db->query($sql);
            $db->bind(":$pk", $id);
            $data = $db->getRow(get_class($this));
            if(empty($data))
                return false;
            
            foreach ($this as $key => $value){
                $this->$key = $data->$key;
            }
        }

        // Deleta uma linha da table a partir de uma instancia do modelo
        public function delete() {
            $db = new MysqlDB();
            $pk = $this::PK;
            $table = $this::TABLE;
            $id = $this->$pk;

            $q = "DELETE FROM $table WHERE $pk = :id";
            $db->query($q);
            $db->bind(':id', $id);
            return $db->execute();
        }

        // Salva ou atualiza dados no BD
        public function save(){
            $db = new MysqlDB();
            $pk = $this::PK;
            $table = $this::TABLE;
            $atts = array();

            if(empty($this->$pk)) { // Salva (INSERT) dados no BD.
                foreach ($this as $key => $value) {
                    $atts[$key] = $value;
                }
                $q = "INSERT INTO $table (".implode(",", array_keys($atts)).") VALUES(:".implode(",:", array_keys($atts)).")";
                $db->query($q);
                foreach ($atts as $key => $value) {
                    $db->bind(':'. $key, $value);
                }
                $result = $db->execute();
                $id = $db->lastInsertId();
                $this->$pk = $id;
                return $result;
            } else { // Atualiza (UPDATE) dados no BD.
                foreach ($this as $key => $value) {
                    $atts[$key] = $value;
                    $fields[] = $key = '=:'.$keys;
                }
                $q = "UPDATE $table SET ". implode(',', array_keys($fields))." WHERE $pk = :id";
                $db->query($q);
                foreach ($variable as $key => $value) {
                    $db->bind(":".$key, $value);
                }
                return $db->execute();
            }
        }
        
        public static function getList(Criteria $criteria = null ){
            $db = new MysqlDB();
            $class = get_called_class();
            $table = $class::TABLE;
            $q = "SELECT * FROM $table";
            if(empty($criteria)){
                $db->query($q);
                return $db->getResults();
            }
            if($criteria->getConditions()){
                $conditions = array();
                foreach ($criteria->getConditions() as $c){
                    $conditions[] = $c[0].' '.$c[1].' :'.$c[0];
                }
                $q .= ' WHERE'.  implode(' AND ', $conditions);
            }
            
            if($criteria->getOrder())
                $q .= ' ORDER BY '.$criteria->getOrder();
            
            if($criteria->getLimit())
                $q .= ' LIMIT '.$criteria->getLimit();
            
            $db->query($q);
            foreach ($criteria->getConditions() as $c){
                $db->bind(':'.$c[0], $c[2]);
            }
            return $db->getResults($class);
        }
    }

?>
