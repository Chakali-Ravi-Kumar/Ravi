<?php 

class DataBase{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "oops_php_crud";
    private $db_port = 3307;



    private $conn = false;
    private $mysqli = "";
    private $result = array();

    public function __construct()
    {
        if(!$this->conn){
            $this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name,$this->db_port);
            $this->conn = true;

            if($this->mysqli->connect_error){
                array_push($this->result,$this->mysqli->connect_error);

                return false;
            }
           
        }else{
            return true;
        }
    }

    public function insert($table,$params = array()){
        if($this->tableExists($table)){
            // print_r($params);
            $table_columns = implode(', ', array_keys($params));
            $table_values = implode("', '", $params);
             $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_values')";
             if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->insert_id);
                return true;
             }else{
                array_push($this->result, $this->mysqli->error);
                return false;
             }
        }else{
            return false;
        }

    }

    

    public function update($table,$params = array(),$where = null){
        if($this->tableExists($table)){
            // print_r($params);
            $args = array();
            foreach($params as $key => $value){
                $args[] = "$key = '$value'";
            }
             $sql = "UPDATE $table SET ". implode(', ',$args);
             if($where != null){
                $sql .= " WHERE $where";
             }
             if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
             }else{
                array_push($this->result, $this->mysqli->error);
                return false;
             }
        }else{
            return false;
        }
    }

    public function delete($table,$where = null){
        if($this->tableExists($table)){
            $sql = "DELETE FROM $table";
            if($where != null){
                $sql .= " WHERE $where";
            }
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
        }else{
            return false;
        }
    }


    private function tableExists($table){
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if($tableInDb){
            if($tableInDb->num_rows == 1){
                return true;
            }else{
                array_push($this->result, $table." Does'nt exists in DB");
                return false;
            }
        }
    }

    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }
}




?>