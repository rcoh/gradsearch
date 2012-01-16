<?php
  session_start();
  require('util.php');
?>
<html>
<body>
<?php
$con = mysql_connect("sql.mit.edu","rcoh","rcoh", TRUE);
mysql_select_db("rcoh+gradschool", $con);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$password=hashpass($_POST['password1']);
/*TODO:
 * check to make sure email doesn't exist
 * password not emtpy
 * passwords match (password1, password2)
 * sanitize inputs
 */
$query = "insert into users 
  (password, fullname, department, email) 
  values ('$password', '$_POST[name]', 
  '$_POST[department]', '$_POST[email]')";

if(!mysql_query($query, $con)){
  die('Error: ' . mysql_error());
}  
echo $_POST["email"]; ?>!</body>
</html>
