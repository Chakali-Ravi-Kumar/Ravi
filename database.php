<?php 

class DataBase{


    private $db_server = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "stu_crud";


    private $conn = false;
    private $mysqli = "";
    private $result = array();

    //to establish the connection
    public function __construct(){

        if(!$this->conn){
            $this->mysqli = new mysqli($this->db_server,$this->db_user,$this->db_pass,$this->db_name);
            $this->conn = true;
            if($this->mysqli->connect_error){
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        }else{
            return true;
        }

    }


    public function insert($table, $params = array()){

        if($this->tableExists($table)){

            echo "<pre>";
            print_r($params);
            echo "</pre>";

            $table_colums = implode(', ',array_keys($params));
            $table_values = implode("', '",$params);

             $sql = "INSERT INTO $table ($table_colums) VALUES ('$table_values')";

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


    //common method to check table exist in data base or not

    private function tableExists($table){

        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table' ";

        $tableIn_db = $this->mysqli->query($sql);

        if($tableIn_db){
            if($tableIn_db->num_rows == 1) {
                return true;
            }else{
                array_push($result, $table."This table is not exist in this Data base");
                return false;
            }
        }

    }


    public function getResult(){
        $value = $this->result;
        $this->result = array();

        return $value;
    }


    //close the connection
    public function __destruct(){
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn = false;
                return true;
            }
        }else{
            return false;
        }
    }
}

?>