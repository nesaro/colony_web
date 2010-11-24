<?php

    $binary = "clnyi.py";
    #echo exec($binary." -t simple-adder -e {\\\"input\\\":\\\"1+1\\\"}");

    //if $_POST array if empty:
    //Call command to get function index
    if (count($_POST) == 0 && count($_GET) == 0)
    {
        echo exec($binary." -c webindex -p");
    }
    if (count($_POST) == 0)
    {
        if (isset($_GET["mode"]) && isset($_GET["app"]) && ($_GET["mode"] == "translate"))
        {
            echo exec($binary." -t webdisplaypage -e {\\\"input\\\":\\\"".$_GET["app"]."\\\"} -o {\\\"output\\\":\\\"stdout\\\"}");
        }

    }
    //if $_POST only have function key:
        //call command to get the function form
    //if $_POST have function and any other key
        //call command to get execution result

?>
