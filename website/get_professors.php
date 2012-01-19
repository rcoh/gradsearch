include util.php;

$get_copy = $_GET;
$query = $get_copy['q'];
unset($get_copy['q']);
$sql_response = filtered_search($query, $get_copy);
    
while($row = mysql_fetch_array($sql_result)) {
  include('prof_box.php');
} 