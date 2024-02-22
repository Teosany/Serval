<?php
function getClass(): BaseClass
{
    spl_autoload_register(function ($class) {
        require_once($class . '.class.php');
    });

    return new BaseClass();
}

