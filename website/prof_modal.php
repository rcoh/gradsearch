<?php 
require('util.php');
$con = get_con();
if(isset($_GET['id'])){
  $result = prof_by_id($_GET['id'], $con);
  $prof = mysql_fetch_array($result);  
}
?>

<div id="m<?php echo $_GET['modal_id']?>" prof_id="<?php echo $_GET['id']?>" class="prof_modal modal hide <?php echo $_GET['classes']?>">
  <div class="modal-header">
    <a href="#" class="close">&times;</a>
    <img id="gold<?php echo $_GET['id']?>" class="gold_star big_star" src="gold_star.png"><img id="gray<?php echo $_GET['id']?>" class="gray_star big_star" src="gray_star.png">
            <h2><?php echo $prof['name'];?></h2>
  </div>
  <div class="modal-body">
    <div class="container-fluid" style="min-width: 890px;">
      <div class="top_content">
        <div class="prof_image">
          <img class="big-thumbnail" src="<?php echo $prof['image'];?>" alt="">
        </div>
      <div class="prof_top_info">
        <p>
<?php echo $prof['school'];?>
        </p>
        <p>
<?php echo $prof['department'];?>
        </p>
<?php
 $website = $prof['personal_website'];
 if (!($website)){
   $website = $prof['lab_website'];
 }
 if ($website){
   echo "<p style=\"text-overflow: ellipsis; overflow: hidden;\"> 
     Website: <a href=\"$website\"> $website </a> </p>";
 }
?>
        <p>
        Research Interests:
<?php 
$result=research_interests($prof['id'], $con);
$first = mysql_fetch_array($result);
$num_results = mysql_num_rows($result);
$num = 0;
if ($first) {
  echo link_to_search_on($first['keyword']);
  if ($num_results <= 12){
    while ($interest = mysql_fetch_array($result)) {
      echo ', ' . link_to_search_on($interest['keyword']);
    }
  }
  else{
    while (($interest = mysql_fetch_array($result)) && ($num<12)) {
      if (strlen($interest['keyword']) > 4){
        echo ', ' . link_to_search_on($interest['keyword']);
        $num++;
      }
    }
  }
} else {
  echo 'None listed.';
}
?>
  </p>
      </div>
    </div>
    <div class="prof_bottom_info">
      <h3>Research Summary</h3>
      <p>
<?php 
$summary = $prof['research_summary']; 
if ($summary) {
  echo $summary;
} else {
  echo 'None listed.';
}
?>
      </p>
<h3>Source</h3>
<a href="<?php echo $prof['source'];?>" >
<?php echo $prof['source'];?>
</a>
                               
      </div>
       </div>
                        </div>
                        <div class="modal-footer" style="padding:5px;">
                            <div class="prof_modal_prev" style="float:left;">
                                <button class="btn primary">Previous</button>
                            </div>
                            <div class="prof_modal_next" style="float:right;">
                                <button class="btn primary">Next</button>
                            </div>
                        </div>
                    </div>
                    

