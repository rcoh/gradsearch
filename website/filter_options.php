<?php
/* json syntax:
 * {"query": 
 *    {"search_string": "blah blah blah",
 *     "school": ["MIT", "Harvard"],
 *     "department": ["Computer Science"],
 *     "...": ["Whatever"] }
 *     
 * }
 * {"categories":
 *  {"schools: {"MIT":5}
 */
require('util.php');
session_start();
$con = get_con();
$search_term = NULL;
if(isset($_GET['q'])) {
  $search_term = $_GET["q"];
}
$get_copy = $_GET; 
unset($get_copy["q"]);
$items = array();
$refinements = array("Starred" => "starred", "University" => "school", "Department" => "department");
$user_id = NULL;
if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}
foreach($refinements as $displayname => $dbname) {
  $working_get = $get_copy;
  unset($working_get["$dbname"]); //leave-one-out
  $distribution = get_professor_distribution($dbname, $search_term, $working_get, $user_id);
  $category_results = array(); 
  while($row = mysql_fetch_array($distribution)) {
    $category_results[$row[$dbname]] = $row['count(*)'];
  }
  $items[] = array("displayname" => $displayname, "dbname" => $dbname, "data" => $category_results);
}
//First do starred adhoc
?>
  <hr style="margin:5px; padding:0px;">
  <div class="clearfix">
    <label id="starred">
      Personal Refinements 
    </label>
    <div class="input" style="margin:0px; padding0px;">
      <ul class="inputs-list">
      <li><label><input type="checkbox" name="true" value="starred" 
      <?php
        if(isset($_GET['starred'])) {
          echo "checked";
        }
      ?>
      />
      <?php 
      if(isset($items[0]['data'][1])) {
        $num = $items[0]['data'][1];
      } else {
        $num = 0;
      } ?>
      <span>Starred (<span id="numstarred"><?php echo $num ?></span>)</span> 
      </label></li>
    </ul>
    </div>
</div>
      
<?php
unset($items[0]);
foreach($items as $category) {
?>
  <hr style="margin:5px; padding:0px;">
  <div class="clearfix">
    <label id="<?php echo $category['dbname']; ?>">
      <?php echo $category['displayname']; ?>
    </label>
    <div class="input" style="margin:0px; padding0px;">
      <ul class="inputs-list">
<?php 

  if(isset($_GET[$category['dbname']])) {
    $selected_refinements = explode(",", $_GET[$category['dbname']]);
  } else {
    $selected_refinements = array();
  }
  foreach($category['data'] as $refinement => $number) { 
        ?>
          <li>
            <label>
              <input type="checkbox" name="<?php echo $refinement; ?>" value="<?php echo $category['dbname']; ?>" 
              <?php 
                if(in_array($refinement, $selected_refinements)) {
                  echo 'checked';
                }
                $selected_refinements = array_diff($selected_refinements, array($refinement));
              ?>
              />
                <span><?php echo "$refinement ($number)"; ?></span>
            </label>
          </li>
        <?php } 
          //Everything left in $selected_refinements is selected but has 0 count, so disable it
        foreach($selected_refinements as $disabled_item) { ?>
              <li>
                <label>
              <input type="checkbox" name="<?php echo $disabled_item; ?>" value="<?php echo $category['dbname']; ?>" 
              disabled checked/>
                <span><?php echo "$disabled_item (0)"; ?></span>
              </label>
              </li>
        <?php } ?>
    
      </ul>
    </div>
  </div>
<?php } ?>

     

