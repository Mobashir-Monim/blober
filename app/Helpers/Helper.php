<?php

namespace App\Helpers;

class Helper
{
    function startsWith($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    }
}