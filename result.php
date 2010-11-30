<?php
    include('session.php');
    $uid = checkSession();
    if (!$uid)
    {
        header('Location:login.php');
        return;
    }

?>
    <a href="do_logout.php">Logout</a>
<?php

//Results:
//If not $_GET && not $_POST,
//show a list of results for current user.


    if (count($_GET) == 0)
    {
        $query = "SELECT * FROM apprequest WHERE iduser='".$uid."';";
        $result = mysql_query($query) or die(mysql_error());
        //ask db for every
        //echo "<form method=\"GET\">";
        while($info = mysql_fetch_array( $result ))
        {
            echo '<a href="result.php?requestsession='.$info['appsession'].'">'.$info['appsession'].'</a><br />';
        }
        //echo "</form>";
            
        return;
    }
    elseif ((count($_GET) > 0) && isset($_GET['requestsession']))
    {
        $query = "SELECT * FROM apprequest WHERE requestsession='".$_GET['requestsession']."';";
        $result = mysql_query($query) or die(mysql_error());
        $info = mysql_fetch_array( $result );
    }
    else
    {
        echo 'Unknown mode';
        return
    } 

?>
