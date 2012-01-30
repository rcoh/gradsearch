<?php 
require('util.php');
$con = get_con();
session_start();
if (isset($_SESSION['user_id'])) {
  $uid = $_SESSION['user_id'];
  $search_url = $_POST['url'];
  $search_desc = $_POST['desc']; 
  $state = $_POST['state'];
  set_starred_search($uid, $search_url, $search_desc, $state, $con);
  echo json_encode(True);
} else {
  echo json_encode(False);
}
?>
