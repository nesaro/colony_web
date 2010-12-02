<?php
    include('session.php');
    $uid = checkSession();
    if (!$uid)
    {
        header('Location:login.php');
        return;
    }

?>
<?php

//Results:
//If not $_GET && not $_POST,
//show a list of results for current user.


    if (count($_GET) == 0)
    {
        echo '<a href="do_logout.php">Logout</a>';
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
    elseif ((count($_GET) == 1) && isset($_GET['requestsession']))
    {
        echo '<a href="do_logout.php">Logout</a>';
        $query = "SELECT * FROM apprequest WHERE appsession='".mysql_real_escape_string($_GET['requestsession'])."';";
        $result = mysql_query($query) or die(mysql_error());
        $info = mysql_fetch_array( $result );
        $inputdic = "{\\\"input\\\":\\\"".$info["app"]."\\\"\\}";
        $outputdic = "{\\\"output\\\":\\\"stdout\\\"}";
        $filelist =  exec($BINARY." -t outputlist -e ".$inputdic."  -o ".$outputdic);
        $filearray = explode(',', $filelist);
        foreach ($filearray as $value) {
            echo '<a href="result.php?requestsession='.$_GET['requestsession'].'&output='.$value.'">'.$value.'</a><br />';
        }
    }
    elseif ((count($_GET) > 1) && isset($_GET['output']))
    {
        $query = "SELECT * FROM apprequest WHERE appsession='".mysql_real_escape_string($_GET['requestsession'])."';";
        $result = mysql_query($query) or die(mysql_error());
        $info = mysql_fetch_array( $result );
        //header("Content-Disposition: attachment; filename=".$_GET['output'].".txt");
        //header("Content-type: text/plain");
        $file = realpath($info['tmppath']."/".$_GET['output']);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        return;

    }
    else
    {
        echo '<a href="do_logout.php">Logout</a>';
        echo 'Unknown mode';
        return;
    } 

?>
