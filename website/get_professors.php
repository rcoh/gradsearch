<?php 
include('util.php');
include('json.php');
$get_copy = $_GET;
$query = $get_copy['q'];
$con = get_con();
unset($get_copy['q']);
$result = filtered_search($query, $get_copy, get_con());
$num_rows = mysql_num_rows($result);
ob_start(); //echos the result into a variable
while($row = mysql_fetch_array($result)) {
  include('prof_box.php');
}
$html = ob_get_contents();
ob_end_clean();

ob_start();
include('search_phrase.php');
$description = ob_get_contents();
ob_end_clean();
if($num_rows == 1) {
  $description = $num_rows . " professor " . $description; 
} else { 
  $description = $num_rows . " professors " . $description; 
}
$ret = array("html" => $html, "description" => $description);
echo json_encode($ret);
?>
