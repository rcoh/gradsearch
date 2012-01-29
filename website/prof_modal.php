<?php 
require('util.php');
$con = get_con();
if(isset($_GET['id'])){
  $result = prof_by_id($_GET['id'], $con);
  $prof = mysql_fetch_array($result);  
}
?>

<div id="m<?php echo $_GET['modal_id']?>" class="prof_modal modal hide <?php echo $_GET['classes']?>">
  <div class="modal-header">
    <a href="#" class="close">&times;</a>
    <img id="gold<?php echo $_GET['id']?>" class="gold_star big_star" src="gold_star.png"><img id="gray<?php echo $_GET['id']?>" class="gray_star big_star" src="gray_star.png">
            <h2><?php echo $prof['name'];?></h2>
  </div>
  <div class="modal-body">
    <div class="container-fluid">
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
        <p>
        Research Interests:
<?php 
$result=research_interests($prof['id'], $con);
$first = mysql_fetch_array($result);
if ($first) {
  echo $first['keyword'];
  while ($interest = mysql_fetch_array($result)) {
    echo ', ' . $interest['keyword'];
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
        <?php echo $prof['research_summary']; ?>
      </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="padding:5px;">
                            <div class="prof_modal_prev" style="float:left;">
                                <a href="#" class="btn primary">Previous</a>
                            </div>
                            <div class="prof_modal_next" style="float:right;">
                                <a href="#" class="btn primary">Next</a>
                            </div>
                        </div>
                    </div>
                    

