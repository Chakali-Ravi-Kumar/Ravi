<?php 
 
    class DataBase{
        private $host;
        private $username;
        private $password;
        private $dbname;

        protected function connect(){
            $this->host = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname = "oops_crud";

            $con = new mysqli($this->host,$this->username,$this->password,$this->dbname);
            return $con;
        }
    }

    class Query extends DataBase{
        public function getData($table,$field='*',$condition,$order_by_field,$order_by_type,$limit=''){

            $sql = "SELECT $field FROM $table";

            if($condition != ''){
                $sql.= ' WHERE ';
                $count = count($condition);
                $pointer = 1;
                foreach($condition as $key => $val){
                    // $sql.= $key.' = '.$val.' and ';
                    if($pointer == $count){
                        $sql.= $key.' = '.$val;
                    }else{
                        $sql.= $key.' = '.$val.' and ';
                    }
                    $pointer++;
                }
            }

            if($order_by_field != ''){
                $sql.=' ORDER BY '.$order_by_field.' '.$order_by_type;
            }

            if($limit != ''){
                $sql.=' LIMIT '.$limit;
            }
            // return $sql;
            // die($sql);

           $result =  $this->connect()->query($sql);


        //     echo "<pre>";

        //     print_r($result);

        //    echo "</pre>";
            if($result->num_rows>0){
                $arr = array();
                while($row = $result->fetch_assoc()){
                    // print_r($row);
                    $arr[] = $row;
                }
                return $arr;
            }else{
                return 0;
            }
        }
    }

?>