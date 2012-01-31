<?php
function insert_active($url) {
    if(strstr($_SERVER['REQUEST_URI'], $url)) {
       echo "class=\"active\"";
    }
}

function loggedin(){
  if (isset($_SESSION['email'])) {
    echo "Logged in as " .$_SESSION['email'];
  }
  else {
    echo "Please <a href=\"loginregister.php\">log in</a> to view your preferences.";
  }
}

?>


<div class="topbar">
    <div class="topbar-inner">
        <div class="container-fluid">
            <a class="brand" href="index.php"><strong>re:</strong>search</a>
            <ul class="nav">
                <li <?php insert_active("index.php"); ?>>
                    <a href="index.php">Home</a>
                </li>
                <li <?php insert_active("about.php"); ?>>
                    <a href="about.php">About</a>
                </li>
            </ul>
            
            <ul class="nav" style="float:right; padding-right:20px;">
                
                <?php if (isset($_SESSION['email'])){
                echo "
                <li>
                  <a href=\"search.php?starred=true\">Starred Professors</a>
                </li>
                <li>
                  <a href=\"starred.php\">Starred Seaches</a>
                </li>
                <li>
                    <a href=\"changepassword.php\">Change Password</a>
                </li>
                <li>
                    <a href=\"signout.php\">Logout</a>
                </li>";
                } ?>
            </ul>
			<p class="pull-right" style="color:gray; padding-right:10px;"> <?php loggedin(); ?>
                <!--Logged in as <a href="profile.php">lalpert</a>-->
                
            </p>
        </div>
    </div>
</div>
