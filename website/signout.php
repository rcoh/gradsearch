<?
require('util.php');
session_start();
session_destroy();
session_start();
$_SESSION['msg'] = array("type" => "success", "text" => "Signout Sucessful!"); //TODO: display this on index.php
go_home();
?>
