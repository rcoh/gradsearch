<?php
require('util.php');
require('json.php');
$con = get_con();
$return_array = array();
if ($con) {
  $query = "select keyword from keywords where keyword like '" . $_GET['term'] . "%';";
  $result = query_or_die($query, $con);
  while ($row = mysql_fetch_array($result)) {
    $row_array['value'] = $row['keyword'];
    array_push($return_array, $row_array);
  }
}
echo json_encode($return_array);
?>
