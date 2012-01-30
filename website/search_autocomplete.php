<?php
require('util.php');
require('json.php');
$con = get_con();
$return_array = array();
if ($con) {
  $query2 = "select name as keyword from prof where match(name) against('$_GET[term]*' in boolean mode) limit 3";
  $query = "select keyword from keywords where keyword like '" . $_GET['term'] . "%' limit 10";
  $query = "$query2 union $query";
  $result = query_or_die($query, $con);
  while ($row = mysql_fetch_array($result)) {
    $row_array['value'] = $row['keyword'];
    array_push($return_array, $row_array);
  }
}
echo json_encode($return_array);
?>
