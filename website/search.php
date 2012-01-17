<!DOCTYPE html>
<?php require('util.php'); ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Graduate School Search</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--><!-- Le styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
        <style type="text/css">
            body {
                padding-top: 60px;
            }
        </style>
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <body>
        <div class="topbar">
            <div class="topbar-inner">
                <div class="container-fluid">
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
                    </ul>
                    <p class="pull-right">
                        Logged in as <a href="#">username</a>
                    </p>
                </div>
            </div>
        </div>
		
        <div class="container-fluid">
            <div class="fixed_sidebar">
                <div class="well">
                    <h5>Sidebar</h5>
                    <ul>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                    </ul>
                    <h5>Sidebar</h5>
                    <ul>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                    </ul>
                    <h5>Sidebar</h5>
                    <ul>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="prof_content">
                <!-- Main hero unit for a primary marketing message or call to action -->
                <div class="hero-unit" style="padding:10px 10px 1px 15px; margin:0px 0px 15px 0px;">
                    <p>
                    Displaying: professors researching <strong><?php echo $_GET['q']; ?></strong>
                    </p>
                </div>
                <ul class="media-grid">
<?php
  $query = $_GET['q'];
  $con = get_con();
  $result = standard_search($query, $con);
  while($row = mysql_fetch_array($result)) {
    echo "<li><a href=\"#\" class=\"prof_box\">";
    echo "<div class=\"prof_image\">";
    echo "<img class=\"thumbnail\" src=\"" . $row['image'] . "\">";
    echo "</div>";
    echo "<div class=\"prof_info\">";
    echo "<strong>" . $row['name'] . "</strong><br>";
    echo $row['school'] . "<br>";
    echo $row['department'];
    echo "</div></a></li>";
  }
?>
                </ul>
                <footer>
                    <p>
                        &copy; Company 2011
                    </p>
                </footer>
            </div>
        </div>
    </body>
</html>
