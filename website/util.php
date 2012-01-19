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

function go_home() {
  header("Location: index.php");
}

function standard_search($query, $con) {
  $stmnt="select distinct prof.id, name, school, department, image from keywords 
    inner join keywordmap on keywords.id=keywordmap.keyword_id 
    join prof on prof.id = keywordmap.prof_id 
    where match (keyword) against ('$query') 
    union select distinct prof.id, name,school, department, image from prof 
    where match(research_summary) against('$query');";
  return query_or_die($stmnt, $con);
}


function filtered_search($query, $con, $params) {
  
  $where_queries = "";
  foreach ($params as $filter => $value_list) {
    $possible_values = join(',',$value_list);  
    $where_queries .= " and $filter in ($possible_values)";   
  }
     
  $stmnt="select distinct prof.id, name, school, department, image from keywords 
    inner join keywordmap on keywords.id=keywordmap.keyword_id 
    join prof on prof.id = keywordmap.prof_id 
    where match (keyword) against ('$query') 
    $where_queries
    union 
    select distinct prof.id, name,school, department, image from prof 
    where match(research_summary) against('$query')
    $where_queries;";
    
  return query_or_die($stmnt, $con);
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
