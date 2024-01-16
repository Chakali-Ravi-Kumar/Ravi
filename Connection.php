<?php 

$localhost = "localhost";
$user = "root";
$pass = "";
$dbname = "responsive";
$conn = mysqli_connect($localhost,$user,$pass,$dbname);
if($conn){
    echo "connected";
}
else{
    echo "not connected";
}
mysqli_close($conn);

?>