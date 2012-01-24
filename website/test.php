<?php 

require('util.php');
$con = get_con();
echo new_anon_user($con);
?>
