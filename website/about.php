<?php 
  session_start();
  require('util.php');
  $con = get_con();
  $max = 8;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>About | re:search</title>
        <meta name="description" content="Search for professors by research interest">
        <meta name="author" content="Leah Alpert, Russell Cohen, Ram Bhaskar">
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--><!-- Le styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
    </head>
    <body>
    <?php include('topbar.php'); ?>
		 <div class="container-fluid">
        <div class="container about_page">
            <section id="About">
                <div class="page-header">
                    <h1>About</h1>
                </div>
                <div class="row">
                    <div class="span16">
                        <p>
                            If you've ever tried to find graduate schools you've probably found it be an infuriating experience. 
                            Existing search engines are focused around finding a particular school.  This makes sense for an  
                            undergraduate education, but for graduate school it's all wrong.  You aren't looking for a school -- 
                            you're looking for a professor. <strong>re:</strong>search solves that problem.  Enter your research interests, broad 
                            or specific, and browse through professors from dozens of universities who are studying what you're  
                            studying. 
                        </p>
                        <p>
                            To use <strong>re:</strong>search, enter a research interest, department, university, or professor's name into the search bar. 
							<strong>re:</strong>search will display professors who match your query. Click on a professor to see their full profile, 
                            including a research summary, awards, and publications. If you register for the site, you can bookmark
                            professors and save searches to view later.
                        </p>
                    </div>
                </div>
            </section>
            <br>
            <section id="Stats">
                <div class="page-header">
                    <h1>The Stats</h1>
                </div>
                <div class="row">
                <div class="span16">

<?php
  $profs = get_distinct('name', $con);
  $num_profs = mysql_num_rows($profs);
  echo "<h3>$num_profs Professors</h3>";
  $num = 0;
  $schools = get_distinct('school', $con);
  $num_schools = mysql_num_rows($schools);
  echo "<h3>$num_schools Universities </h3>";
  echo "<ul>";
  while(($result = mysql_fetch_array($schools)) && $num <= $max) {
    echo "<li>$result[school]</li>";
    $num += 1;
  }
echo "</ul>";
  $departments = get_distinct('department', $con);
  $num_depts = mysql_num_rows($departments);
  echo "<h3>$num_depts Departments <small>including</small></h3>";
?>
  <ul>
<li>Biology</li>
 <li>Chemical Engineering</li>
 <li>Civil Engineering</li>
 <li>Computer Science</li>
 <li>Economics</li>
 <li>English</li>
 <li>Mathematics </li>
 <li>Mechanical Engineering</li>
 <li>Medicine</li>
 <li>Psychiatry</li>
 <li>Physics</li>

  <li>and many, many more</li>
                    </ul>
                </div>
            </section>
            <br>
            <section id="Contact">
                <div class="page-header">
                    <h1>Contact Us</h1>
                </div>
                <div class="row">
                    <div class="span16">
                        <p>
                            For questions or comments, contact us at gradsearch 
                            &lt;at&gt; mit  &lt;dot&gt; edu
                        </p>
                    </div>
                </div>
            </section>
			<br>
			 </div>
            <footer>
                <p>
                    &copy; LRR productions 2012
                </p>
            </footer>
       </div>
    </body>
</html>
