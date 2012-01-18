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
  if(add_user($email, $password, $con)) {
    $_SESSION['msg'] = array("type" => "success", "text" => "Signup Sucessful!"); //TODO: display this on index.php
    $_SESSION['email'] = $_POST['email'];
    go_home();
  } else {
    die('Error: ' . mysql_error());
  }
}
?>
