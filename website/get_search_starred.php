<?php
$starred = search_starred_by_user('?' . $_SERVER["QUERY_STRING"], $_SESSION['user_id']);

?>
<img class="gold_star search_star"  <?php if(!$starred) { echo 'style="display:none"'; } else { echo 'style="display:inline"'; } ?>
  src="gold_star.png">
<img class="gray_star search_star"  <?php if($starred) { echo 'style="display:none"'; } ?> src="gray_star.png">
