<?php 

include ('DataBase.php');
$obj = new Query();

$condition = array('id' => 2,'name' => 'shalini');
$result = $obj->getData('users','*',$condition='','id','desc','7');

echo "<pre>";
print_r($result);
echo "</pre>";


?>