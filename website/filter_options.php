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
$con = get_con();
$search_term = $_GET["q"];
$get_copy = $_GET; 
unset($get_copy["q"]);
$items = array();
$refinements = array("University" => "school", "Department" => "department");
foreach($refinements as $displayname => $dbname) {
  $working_get = $get_copy;
  unset($working_get["$dbname"]); //leave-one-out
  $distribution = get_professor_distribution($dbname, $search_term, $working_get, $con);
  $category_results = array(); 
  while($row = mysql_fetch_array($distribution)) {
    $category_results[$row[$dbname]] = $row['count(*)'];
  }
  $items[] = array("displayname" => $displayname, "dbname" => $dbname, "data" => $category_results);
}

foreach($items as $category) {
?>
  <hr style="margin:5px; padding:0px;">
  <div class="clearfix">
    <label id="<?php echo $category['dbname']; ?>">
      <?php echo $category['displayname']; ?>
    </label>
    <div class="input" style="margin:0px; padding0px;">
      <ul class="inputs-list">
        <?php foreach($category['data'] as $refinement => $number) { ?>
          <li>
            <label>
              <input type="checkbox" name="<?php echo $refinement; ?>" value="<?php echo $category['dbname']; ?>" 
              <?php 
                if(isset($_GET[$category['dbname']])) {
                  $selected = explode(",", $_GET[$category['dbname']]);
                  foreach($selected as $filter_item) {
                    if($refinement == $filter_item){
                      echo 'checked';
                    }
                  }
                }
              ?>
              />
                <span><?php echo "$refinement ($number)"; ?></span>
            </label>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
<?php } ?>

     

