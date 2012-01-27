<?php 
include('util.php');
include('json.php');
session_start();
$get_copy = $_GET;
$query = NULL;
if(isset($get_copy['q'])) {
  $query = $get_copy['q'];
}
$con = get_con();
unset($get_copy['q']);
$uid = NULL;
if(isset($_SESSION['user_id'])) { 
  $uid = $_SESSION['user_id'];
}
$start = NULL;
$limit = 10;
if(isset($_GET['start'])) {
  $start = $_GET['start'];
}
if(isset($_GET['start'])) {
  $start = $_GET['start'];
}
unset($get_copy['start']);
unset($get_copy['limit']);
$result_array = filtered_search($query, $get_copy, $uid, $limit, $start, get_con());
$result = $result_array['result'];
$num_rows = $result_array['count'];
ob_start(); //echos the result into a variable
while($row = mysql_fetch_array($result)) {
  include('prof_box.php');
}
$html = ob_get_contents();
ob_end_clean();

ob_start();
include('search_phrase.php');
$description_end = ob_get_contents();
ob_end_clean();
$description = $num_rows;
if(isset($_GET['starred'])) {
  $description .= ' <strong>starred</strong>';
}
if($num_rows == 1) {
  $description .= " professor " . $description_end; 
} else { 
  $description .= " professors " . $description_end; 
}
$ret = array("html" => $html, "description" => $description);
echo json_encode($ret);
?>
