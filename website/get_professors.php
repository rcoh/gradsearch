<?php 
include('util.php');
$get_copy = $_GET;
$query = $get_copy['q'];
$con = get_con();
unset($get_copy['q']);
$result = filtered_search($query, $get_copy, get_con());
    
while($row = mysql_fetch_array($result)) {
  include('prof_box.php');
} ?>
