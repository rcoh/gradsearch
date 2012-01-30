<?php
$pat = '/&{0,1}start=\d{1,2}&limit=\d{1,2}/';
$query = preg_replace($pat, '', $_SERVER["QUERY_STRING"]);
$starred = search_starred_by_user('?' . $query, $_SESSION['user_id']);
?>
<img class="gold_star search_star"  <?php if(!$starred) { echo 'style="display:none"'; } else { echo 'style="display:inline"'; } ?>
  src="gold_star.png">
<img class="gray_star search_star"  <?php if($starred) { echo 'style="display:none"'; } ?> src="gray_star.png">
