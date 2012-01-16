<?php
  session_start()
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Graduate School Search</title>
        <meta name="description" content="Search for professors by research interest">
        <meta name="author" content="Leah Alpert, Russell Cohen, Ram Bhaskar">
        <!-- styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
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
        <div class="topbar">
            <div class="fill">
                <div class="container">
                    <a class="brand" href="#">Graduate School Search</a>
                    <ul class="nav">
                        <li class="active">
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                        <?php
                          if (isset($_SESSION['email'])) {
                            echo "<li><a href=\"#profle\"> Welcome $_SESSION[email]</li>";
                          } else {
                            echo "<li><a href=\"login.php\">Login</a>";
                          }
                        ?>  
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="floater" style="height:150px;">
            </div>
            <div class="center">
                <form>
                    <fieldset>
                        <legend style="padding-left: 0px;">
                            What are you interested in?
                        </legend>
                        <div class="input" style="margin-left: 10px;">
                            <input class="xlarge" id="xlInput" name="xlInput" size="30" type="text" style="color:black;"/>&nbsp;<input type="submit" class="btn primary" value="Go">
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="floater" style="height:150px;">
            </div>
            <footer class="center" style="vertical-align:bottom;">
                <p>
                    &copy; LeahRussellRam Productions 2011
                </p>
            </footer>
        </div>
        <!-- /container -->
    </body>
</html>
