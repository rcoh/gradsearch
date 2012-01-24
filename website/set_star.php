<?php 
require('util.php');
$con = get_con();
session_start();
if (isset($_SESSION['user_id'])) {
  $uid = $_SESSION['user_id'];
  $pid = $_POST['id'];
  $state = $_POST['state'];
  set_starred($pid, $uid, $state, $con);
  echo json_encode(True);
} else {
  echo json_encode(False);
}
?>
