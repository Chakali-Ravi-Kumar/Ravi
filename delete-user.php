<?php 

include "config.php";

$userid = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$userid}";

if(mysqli_query($conn,$sql)){
    header("Location: {$hostname}/admin/users.php");
}else{
    echo "cannot delete the user record";
}
mysqli_close($conn);

?>