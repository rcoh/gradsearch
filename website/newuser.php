<?php
session_start();
require('util.php');
$p1 = $_POST['password'];
$p2 = $_POST['confirm_password'];
$password=hashpass($p1);
$email=$_POST['email'];
$con = get_con();
/*TODO:
 * check to make sure email doesn't exist
 * password not emtpy
 * passwords match (password1, password2)
 * sanitize inputs
 */
if($p1 == $p2 && !email_exists($email, $con)) {
  $uid = add_user($email, $password, $con); 
  if($uid) {
    $_SESSION['msg'] = array("type" => "success", "text" => "Signup Sucessful!"); //TODO: display this on index.php
    $_SESSION['email'] = $_POST['email'];
    if(isset($_SESSION['user_id'])) {
      //Anon user pattern, merge delete
      merge_users($_SESSION['user_id'], $uid);
      delete_user($_SESSION['user_id']);
    }
    $_SESSION['user_id'] = $uid;
    go_home();
  } else {
    die('Error: ' . mysql_error());
  }
}
?>
