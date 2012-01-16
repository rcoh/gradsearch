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
if(isset($_POST['pass']) && isset($_POST['email'])) {
  $hashed=hashpass($_POST['pass']); 
  $query = "select password from users 
    where email='$_POST[email]'";
  $result = query_or_die($query, $con);
  $row = mysql_fetch_row($result);
  if($row[0] == $hashed) {
    $_SESSION['email'] = $_POST['email'];
  } else {
    echo 'login failed <br \>';
    echo $row[0];
    echo '<br />';
    echo $hashed;
  }
} 
?>
<form action="login.php" method="post">
Email: <input type="text" name="email" /> <br />
Password: <input type="password" name="pass" /> <br />
<input type="submit" /> 
</body>
</html>
<!--
  TODO:
    Sanitize inputs
    Beautify?
    Make Async
-->
