<?php
require('util.php');
require('json.php');
$con = get_con();
$return_array = array();
if ($con && isset($_GET['email'])) {
  array_push($return_array, email_exists($_GET['email'], $con));
}
echo json_encode($return_array);
?>
