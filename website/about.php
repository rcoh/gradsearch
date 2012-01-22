<?php
  session_start();
  require('util.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>re:search</title>
        <meta name="description" content="Search for professors by research interest">
        <meta name="author" content="Leah Alpert, Russell Cohen, Ram Bhaskar">
        <!-- styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/autocomplete.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/bootstrap-alerts.js"></script>
        <style type="text/css">
            body {
                padding-top: 60px;
            }
        </style>
        <!-- Le fav and touch icons ??? -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <body>
       <?php include('topbar.php'); ?>
       <div class="container">
<p>        
If you've ever tried to find grad schools you've probably found it be an infuriating experience.
Existing search engines are focused around finding a particular school.  This makes sense for an
undergraduate education, but for graduate school it's all wrong.  You aren't looking for a school --
you're looking for a professor.  <strong>re:</strong>search solves that problem.  Enter your research interests, broad
or specific, and browse through professors from dozens of universities studying what you're
studying. 
</p>
<p>
To use <strong>re:</strong>search, enter a research interest, university, or professor's name into the search bar. 
<strong>re:</strong>search will display professors who match your query. Click on a professor to see their full profile, 
including a research summary, awards, and publications. If you register for the site, you can bookmark
professors to view later.
</p> 
<p>
For questions and comments, contact us at gradsearch <at> mit <dot> edu
</p>
</body>
</html>
