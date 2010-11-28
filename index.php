<?php
    //table: users
    //store in table: user - sessioncookie - date
    //store in table: sessioncookie -  requestcookie - date

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
        //generate requestsession directory
        //store results at directory
        //refresh to result.php?requestsession=value
    }

?>
