<?php
session_start();
include('util.php');
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
        <!-- styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">
        </script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js">
        </script>
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
        <?php include('topbar.php'); 
  if (isset($_SESSION['msg'])) {
            ?>
        <div class="alert-message fade in <?php echo $_SESSION['msg']['type']; ?>">
            <a class="close" href="#">×</a>
            <p>
                <?php echo $_SESSION['msg']['text']; ?>
            </p>
        </div>
        <?php
   unset($_SESSION['msg']); 
} ?>
        <div class="container">
            <div id="main_search_box">
                <form id="search" action="search.php">
                    <fieldset>
                        <legend style="padding-left: 0px;">
                            What are you interested in?
                        </legend>
                        <div class="input" style="margin-left: -30px;">
                            <input class="xlarge" id="search" name="q" size="30" type="text" style="color:black;"/>&nbsp;<input type="submit" class="btn primary" value="Go">
                        </div>
                    </fieldset>
                </form>
            </div>
            <div id="main_page_bottom">
                <div class="row">
                    <div class="span-one-third">
                        <h2>Discover</h2>
                        <p>
                            re:search helps you find professors who share your research interests. Explore our database of thousands of professors from 5 top universities.
                        </p>
                        <p>
                            <a class="btn" href="about.php">More details &raquo;</a>
                        </p>
                    </div>
                    <div class="span-one-third">
                        <h2>Search</h2>
                        <p>
                            Enter a research interest, department, or professor's name into the search bar above to get started. 
                        </p>
                        <p>
                            <a class="btn" href="about.php#Stats">More details &raquo;</a>
                        </p>
                    </div>
                    <div class="span-one-third">
                        <h2>Login</h2>
                        <p>
                            Make an account to save your searches and keep track of your favorite professors.  Search within your pool of favorite professors to refine your query.
                        </p>
                        <p>
                            <a class="btn" href="loginregister.php">Login/Register &raquo;</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="stuck">
            <p>
                &copy; 2012 re:search
            </p>
        </footer>
    </body>
</html>
