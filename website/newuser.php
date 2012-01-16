<html>
<body>
<?php
$con = mysql_connect("sql.mit.edu","rcoh","rcoh", TRUE);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
echo crypt($_post["password1"]);
?>
Welcome <?php echo $_POST["email"]; ?>!<br />

</body>
</html>
