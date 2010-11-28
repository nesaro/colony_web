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

    $binary = "clnyi.py";
    #TODO: protect app from command line injection

    //if $_POST array if empty:
    //Call command to get function index
    if (count($_POST) == 0 && count($_GET) == 0)
    {
        echo exec($binary." -c webindex -p");
        return;
    }
    elseif (count($_POST) == 0)
    {
        if (isset($_GET["mode"]) && isset($_GET["app"]) && ($_GET["mode"] == "translate"))
        {
            $inputdic = "{\\\"input\\\":\\\"".$_GET["app"]."\\\"\\,\\\"session\\\":\\\"".rand()."\\\"}";
            $outputdic = "{\\\"output\\\":\\\"stdout\\\"}";
            echo exec($binary." -t webdisplaypage -e ".$inputdic."  -o ".$outputdic);
        }
        elseif (isset($_GET["mode"]) && isset($_GET["app"]) && ($_GET["mode"] == "procedure"))
        {
            echo exec($binary." -c ".$_GET["app"]." -p ");
        }
        else
        {
            echo "Unknown mode";
        }
        return;
    }
    else
    {
        $tmpdir = tempnam();
        //generate requestsession directory
        //store dir in requestsession table
        //store results at directory
        //refresh to result.php?requestsession=value
    }

?>
