<?php
  session_start();
  require('util.php');
  $query = $_GET['q'];
  $con = get_con();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>IWantToStud.ty</title>
        <meta name="description" content="Search for professors by research interest">
        <meta name="author" content="Leah Alpert, Russell Cohen, Ram Bhaskar">
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--><!-- Le styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/search.js"></script>
        <script type="text/javascript" src="js/autocomplete.js"></script>
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <body>
        <?php include('topbar.php'); ?>
        <div class="search_bar">
            <form class="bar_form" action="search.php">
                <label for="search" style="width:auto; padding-left:10px;">
                    Search
                </label>
                <div class="input" style="margin-left:65px;">
                <input id="search" name="q" <?php if(isset($_GET['q'])) { echo "value=\"$_GET[q]\""; } ?> size="30" type="text" />&nbsp;<input type="submit" class="btn info" value="Go">
				</div>
            </form>
			
        </div>
        <div class="container-fluid">
            <div class="fixed_sidebar">
                <div class="well" style=" padding:0px;">
                    <form action="" id="filter" class="form-stacked" style="padding:8px;">
                        <h5>Filter results by:</h5>
                        <span id="filter"></span>
                    </form>
                </div>
            </div>
            <div class="prof_content">
                <div class="hero-unit" style="padding:10px 10px 1px 15px; margin:0px 0px 15px 0px;">
                    <p id="search_description">
                    </p>
                </div>
                <ul class="media-grid prof_grid">
                </ul>
                <footer>
                    <p>
                        &copy; Leah Alpert, Russell Cohen, Ram Bhaskar 2012
                    </p>
                </footer>
            </div>
        </div>
    </body>
</html>
