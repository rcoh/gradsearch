<?
#require('util.php');
session_start();
session_destroy();
session_start();
$_SESSION['msg'] = array("type" => "success", "text" => "Your password has been sent to your email address. Please check your mail soon!"); //TODO: display this on index.php
go_home();
?>
