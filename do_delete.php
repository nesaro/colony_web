<?php
    include('session.php');
    $uid = checkSession();
    if (!$uid)
    {
        header('Location:login.php');
        return;
    }
    include ('config.php');
    mysql_connect($DBHOST, $DBUSER, $DBPASS);
    mysql_select_db($DBNAME);
    $query = "DELETE FROM users ";
    $query .= "WHERE id='".mysql_real_escape_string($uid)."'";
    $result = mysql_query($query) or die(mysql_error());
    header('Location:do_logout.php');
    
?>

