<?php
    include('session.php');
    $uid = checkSession();
    if (!$uid)
    {
        header('Location:login.php');
        return;
    }
    
?>

<html>
<head>
<title>User administration</title>
</head>
<body>
<?php

    $query = "SELECT * FROM users WHERE id='".mysql_real_escape_string($uid)."'";
    $result = mysql_query($query) or die(mysql_error());
    $info = mysql_fetch_array( $result );
    $username = $info['name'];
    $userlevel = $info['userlevel'];
    if ($userlevel == 1)
    {
        echo "Welcome ".$username.",<br />";
        echo "You are logged as a basic user. You'll be able to change this later<br />";
        echo '<a href="do_delete.php">Delete account</a>';
    }
    else
    {
        die("Unknow user type");
    }
    //Access to your space (Premium, standard)
    //Change user mode
    ////Premium (100Mb space, all services)
    ////Standard (10Mb space, some services)
    ////Basic    (No spaces, ads, least services
    //
    //Dump your space to file
    //delete user
?>
</body>
</html>
