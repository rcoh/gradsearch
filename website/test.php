<?php 
require('util.php');
get_con();
echo mysql_real_escape_string('"test query"');
?>
