<?php
  session_start();
  require('util.php');
  $con = get_con();
  if(!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = new_anon_user($con);
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>re:search</title>
        <meta name="description" content="Search for professors by research interest">
        <meta name="author" content="Leah Alpert, Russell Cohen, Ram Bhaskar">
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--><!-- Le styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/starred.js"></script>
        <script type="text/javascript" src="js/autocomplete.js"></script>
        <script type="text/javascript" src="js/bootstrap-twipsy.js"></script>
        <script type="text/javascript" src="js/bootstrap-popover.js"></script>
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <body>
        <?php include('topbar.php'); ?>
        <div class="search_bar" style="min-width: 980px;">
           <form id="search" action="search.php" class="bar_form" style="float:left;">
                <label for="search" style="width:auto; padding-left:10px;">
                    Search
                </label>
                <div class="input" style="margin-left:65px;">
                <input id="search" name="q" <?php if(isset($_GET['q'])) { echo "value=\"$_GET[q]\""; } ?> size="30" type="text" />&nbsp;<input type="submit" class="btn primary" value="Go">
                </div>
            </form>
            <div style="float:left;" >
                <ul id="saved_pills" class="pills">
                    <li id="starred">
                        <a href="search.php?starred=true">Show All Starred Profs</a>
                    </li>
                    <li id="saved">
                        <a>Show Starred Searches</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="main_search" class="container-fluid">
        			 </div>
            <footer>
                <p>
                    &copy; 2012 Leah Alpert, Russell Cohen, Ram Bhaskar
                </p>
            </footer>
       </div>
 </div>
    </body>
</html>
