<?php 
require('util.php');
$con = get_con();
if(isset($_GET['id'])){
  $result = prof_by_id($_GET['id'], $con);
  $prof = mysql_fetch_array($result);  
} else {
  go_home();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>re:search</title>
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
        <?php include('topbar.php'); ?>
        <div class="container-fluid">
            <div class="top_content">
                <div class="prof_image">
                <img class="big-thumbnail" src="<?php echo $prof['image']; ?> " alt="">
                </div>
                <div class="hero-unit" style="height:170px; padding:1px 10px 1px 15px; margin:0px 0px 10px 160px;">
                    <p>
                    <h2><?php echo $prof['name'];?></h2>
                        <p>
                          <?php echo $prof['school'];?>
                            <br>
                          <?php echo $prof['department'];?>
                        </p>
                        <hr style="margin:0px 0px 5px 0px;">
                        <p>
Research Interests:
<?php 
$result=research_interests($prof['id'], $con);
$first = mysql_fetch_array($result);
if ($first) {
  echo $first['keyword'];
  while ($interest = mysql_fetch_array($result)) {
    echo ', ' . $interest['keyword'];
  }
} else {
  echo 'None listed.';
}
?>
                        </p>
                    </p>
                </div>
            </div>
			
			 <div class="hero-unit" style="padding:15px 30px;">
			 	
				<h3>Research Summary</h3>
        <p style="font-size:14px;">
        <?php echo $prof['research_summary']; ?>
        </p>
			 </div>
            <footer>
                <p>
                    &copy; Company 2011
                </p>
            </footer>
        </div>
    </body>
</html>
