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
$limit = 100;
if(isset($_GET['start'])) {
  $start = $_GET['start'];
}
if(isset($_GET['limit'])) {
  $limit = $_GET['limit'];
}
unset($get_copy['start']);
unset($get_copy['limit']);
$result_array = filtered_search($query, $get_copy, $uid, $limit, $start, get_con());
$result = $result_array['result'];
$num_rows = $result_array['count'];
$num_returned = mysql_num_rows($result);
ob_start(); //echos the result into a variable
if (!$start){
  $count = 0;
}else{
  $count = $start;
}
while($row = mysql_fetch_array($result)) {
  include('prof_box.php');
  $count++;
}
$html = ob_get_contents();
ob_end_clean();

ob_start();
include('search_phrase.php');
$description_end = ob_get_contents();
ob_end_clean();

ob_start();
include('get_search_starred.php');
$star = ob_get_contents();
ob_end_clean();

$description = $num_rows;
$description_end = htmlspecialchars($description_end);
if(isset($_GET['starred'])) {
  $description .= ' <strong>starred</strong>';
}
if($num_rows == 1) {
  $description .= " professor " . $description_end; 
} else { 
  $description .= " professors " . $description_end; 
}


$ret = array("html" => $html, "description" => $description, "num_returned" => $num_returned, "search_star" => $star);
echo json_encode($ret);
?>
