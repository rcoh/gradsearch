<?php 
if(isset($_GET['q'])) {
  echo 'researching ';
  echo "<strong>" . htmlspecialchars($_GET['q']) . "</strong>";
}
$params = array("school" => "at", "department" => "in");
foreach($params as $param => $delim) {
  if(isset($_GET[$param])) {
    $items = explode(',', $_GET[$param]);
    if(count($items) > 1) {
      echo " " . $delim . " <strong>" . count($items) . " </strong>" . $param . "s";  
    } else {
      echo " $delim <strong>" . $items[0] . "</strong>";
    }
  }
}
?>
