<?php
require('util.php');

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
    echo "Please log in to view your preferences.";
    }
}

?>


<div class="topbar">
    <div class="topbar-inner">
        <div class="container-fluid">
            <a class="brand" href="index.php">IWantToStud.ty</a>
            <ul class="nav">
                <li <?php insert_active("index.php"); ?>>
                    <a href="index.php">Home</a>
                </li>
                <li <?php insert_active("about.php"); ?>>
                    <a href="about.php">About</a>
                </li>
                <li <?php insert_active("contact.php"); ?>>
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
            
            <ul class="nav" style="float:right; padding-right:20px;">
                <li>
                    <a href="profile.php">Profile</a>
                </li>
                <li>
                    <a href="signout.php">Logout</a>
                </li>
            </ul>
			<p class="pull-right" style="color:gray; padding-right:10px;"> <?php loggedin(); ?>
                <!--Logged in as <a href="profile.php">lalpert</a>-->
                
            </p>
        </div>
    </div>
</div>
