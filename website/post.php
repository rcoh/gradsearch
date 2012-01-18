<?php
require('util.php');
require('json.php');
$return_array=array();
$user_email = $_GET['email'];
if (check_email($user_email)== false){
   array_push($return_array, false);
}
else {
array_push($return_array, true);}

echo json_encode($return_array);
?>