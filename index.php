<?php

    $binary = "clnyi.py";
    #echo exec($binary." -t simple-adder -e {\\\"input\\\":\\\"1+1\\\"}");

    //if $_POST array if empty:
    //Call command to get function index
    if (count($_POST) == 0)
    {
        echo exec($binary." -c webindex -p");
    }
    //if $_POST only have function key:
        //call command to get the function form
    //if $_POST have function and any other key
        //call command to get execution result

?>
