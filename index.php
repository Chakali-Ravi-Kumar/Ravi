<?php 

include "database.php";

$obj = new DataBase();

$obj->insert('student',['name'=>'shalini','email'=>'shalini143@gmail.com','gender'=>'female','qualification'=>'B.Tech']); 

echo "The inserted result is : ";

print_r($obj->getResult());

?>