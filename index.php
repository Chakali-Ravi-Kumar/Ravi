<?php 

include "database.php";

$obj = new DataBase();

// $obj->insert('employees',['name' => 'Darling', 'age' => 22, 'city' => 'Guntakal']);

// echo "Insert result is :";
// print_r($obj->getResult());

// $obj->update('employees',['name' => 'Krishna Kumar Kunnat', 'age' => 39, 'city' => 'Hyderabad'],'id = "1"');

// echo "Update result is :";
// print_r($obj->getResult());

// $obj->update('employees',['city' => 'Bangalore'],'city = "Guntakal"');

// echo "Update result is :";
// print_r($obj->getResult());

$obj->delete('employees','id = "4"');

echo "Delete result is :";
print_r($obj->getResult());




?>