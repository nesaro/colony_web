<?php

    $binary = "/home/nesaro/proyectos/translator/git/bin/clnyiwrapper.sh";
    echo exec($binary." -t simple-adder -e {\\\"input\\\":\\\"1+1\\\"}");

//Si se pasa el index sin nada,
//listar los programas
//si se pasa con f, mostrar el form de la funcion
//si se pasa con f + parametros, devolver el resultado
?>
