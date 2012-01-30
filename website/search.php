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
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/search.js"></script>
        <script type="text/javascript" src="js/autocomplete.js"></script>
        <script type="text/javascript" src="js/bootstrap-twipsy.js"></script>
        <script type="text/javascript" src="js/bootstrap-popover.js"></script>
        <script type="text/javascript" src="js/bootstrap-modal.js">
        </script>
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <body>
        <?php include('topbar.php'); ?>
        <div class="search_bar" style="min-width: 980px;">
           <form id="search" class="bar_form" style="float:left;">
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
                        <a>Show All Starred Profs</a>
                    </li>
                    <li id="saved">
                        <a href="starred.php">Show Starred Searches</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="main_search" class="container-fluid">
            <div class="fixed_sidebar">
                <div class="well" style=" padding:0px;">
                    <form action="" id="filter" class="form-stacked" style="padding:8px;">
                        <h5>Filter results by:</h5>
                        <span id="filter">Loading...</span>
                    </form>
                </div>
            </div>
            <div class="prof_content">
        <?php 
  if(!isset($_SESSION['anon_msg'])) { ?>
        <div class="alert-message fade in sucess">
            <a class="close" href="#">×</a>
            <p>
            Hey there! We use the 
            <strong>anonymous user pattern </strong>here.  That means you can 
            <strong>star</strong> and <strong>save</strong> searches to your heart's content, 
            but you'll <strong>lose them if you close your browser.</strong>  <strong>But:</strong> If you log in or create an account, we'll <strong>add in</strong> all your <strong>starred professors and saved searches.</strong>  Happy searching!  
            </p>
            </div>
<?php
      $_SESSION['anon_msg'] = true;
  } ?>
                <div class="hero-unit" id="search_description">
                    <p id="search_description">
                      <span id="search_description">
                      Loading...
                      </span>
                    <span id="searchstar">
                    <?php include('get_search_starred.php'); ?>
                    </span>
                    <span style="float:right; font-size:12px; padding-right:5px;">Save search </span>
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
