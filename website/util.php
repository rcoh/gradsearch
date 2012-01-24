<?php
function hashpass($password) {
  return crypt($password, '$2a$07$hyperagressive123jkasdfakrjtwkrjaskfjasdkfjaf$');
}

function get_con() {
  $con = mysql_pconnect("sql.mit.edu","rcoh","rcoh");
  mysql_select_db("rcoh+gradschool", $con);
  if (!$con)
  {
    die('Could not connect: ' . mysql_error());
  }
  return $con;
}

function query_or_die($query, $con) {
  $result = mysql_query($query, $con);
  if(!$result){
    die('Error: ' . mysql_error());
  } else {
    return $result;
  } 
}

function go($loc) {
  header("Location: " . $loc);
}
function go_home() {
  header("Location: index.php");
}

function add_user($email, $hashpass, $con) { 
  $query = sprintf("insert into users (password, email) values('%s', '%s')",
          mysql_real_escape_string($hashpass),
          mysql_real_escape_string($email));
  return query_or_die($query, $con);
}
function standard_search($query, $con) {
  $stmnt="select distinct prof.id, name, school, department, image from keywords 
    inner join keywordmap on keywords.id=keywordmap.keyword_id 
    join prof on prof.id = keywordmap.prof_id 
    where match (keyword) against ('\"$query\"' in boolean mode) 
    union select distinct prof.id, name,school, department, image from prof 
    where match(research_summary) against('\"$query\"' in boolean mode);";
  return query_or_die($stmnt, $con);
}


function filtered_search($query, $params, $uid, $con) {
  $cols = array("prof.id", "name", "school", "department", "image");
  return query_or_die(build_query_string($cols, $query, $params, $uid), $con);
}

function set_starred($prof_id, $user_id, $state, $con) {
  if($state == "true") {
    $stmnt = "insert into bookmarked_professors (prof_id, user_id) values($prof_id, $user_id)";
  } else {
    $stmnt = "delete from bookmarked_professors where prof_id = '$prof_id' and user_id = '$user_id'";
    echo $stmnt;
  }
  return query_or_die($stmnt, $con);
}
function build_query_string($cols, $search_term, $params, $user_id = NULL) {
  if($user_id) {
    array_push($cols, "prof.id in (select prof_id from bookmarked_professors where user_id = $user_id) as starred");
    return build_query_string($cols, $search_term, $params);
  }
  $where_queries = "";
  foreach ($params as $filter => $value_list) {
    $vals = explode(",", $value_list);
    $possible_values = "'" . join('\',\'', $vals) . "'";  
    $where_queries .= " and $filter in ($possible_values)";
  }
  $col_terms = implode(", ", $cols);   
  $stmnt="select " . $col_terms . " from keywords 
    inner join keywordmap on keywords.id=keywordmap.keyword_id 
    join prof on prof.id = keywordmap.prof_id 
    where match (keyword) against ('\"$search_term\"' in boolean mode) 
    $where_queries
    union 
    select distinct $col_terms from prof 
    where match(research_summary) against('\"$search_term\"' in boolean mode)
    $where_queries";
  return $stmnt;

}

function get_professor_distribution($col, $search_term, $params, $con) {
  $cols = array($col, "prof.id");
  $query = 
    "select $col, count(*) from (" . 
      build_query_string($cols, $search_term, $params) . 
    ") as T group by $col order by count(*) desc";
  return query_or_die($query, $con);
}
function prof_by_id($prof_id, $con) {
  $stmnt="select * from prof where id='$prof_id'";
  return query_or_die($stmnt, $con);
}

function research_interests($prof_id, $con) {
  $stmnt = "select distinct keyword from keywords inner join keywordmap on 
    keywords.id=keywordmap.keyword_id join prof 
    on prof.id = keywordmap.prof_id where prof.id=$prof_id;";
  return query_or_die($stmnt, $con);
}

function email_exists($email, $con) {
  $dbemails = mysql_query("SELECT * FROM users WHERE email='$email'", $con);
  return (mysql_num_rows($dbemails) > 0);
}

function get_distinct($col, $con) {
  $stmnt = "select distinct $col, count(*) from prof group by $col order by count(*) desc";
  return query_or_die($stmnt, $con);
}

function research_interests_str($prof_id, $con, $search_string) {
  $result=research_interests($prof_id, $con);
  $first = mysql_fetch_array($result);
  if ($first) {
    $output = $first['keyword'];
    if ($output == $search_string) {
      $output = '<b>' . $output . '</b>';
    }
    while ($interest = mysql_fetch_array($result)) {
      if ($interest['keyword'] == $search_string) {
        $output = '<b>' . $interest['keyword'] . '</b>, ' . $output;
      } else {
        $output = $output . ', ' . $interest['keyword'];
      }
    }
  } else {
    $output = 'None listed.';
  }
  return $output;
}
?>
