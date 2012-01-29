<?php
include('util.php');
session_start();
$searches = get_searches_for_user($_SESSION['user_id']);
while($query = mysql_fetch_array($searches)) { ?>
  <a href="search.php<?php echo $query['url']?>" class="saved_search" id="<?php echo $query['url']?>" desc="<?php echo $query['description']; ?>">
<p>
<?php 
  echo $query['description']; 
  $starred = true;
?>
<img class="gold_star search_star"  <?php if(!$starred) { echo 'style="display:none"'; } else { echo 'style="display:inline"'; } ?>
  src="gold_star.png">
<img class="gray_star search_star"  <?php if($starred) { echo 'style="display:none"'; } ?> src="gray_star.png">
  
        <span class="save">Save search </span>
        </p>
      </div>
<?php
}
?>
