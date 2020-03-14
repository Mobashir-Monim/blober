<?php

namespace App\Helpers;

class Helper
{
    public function startsWith($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    }

    public function objToArray($obj, $reset)
    {
        if ($reset) {
            return array_values(json_decode(json_encode($obj), true));
        } else {
            return json_decode(json_encode($obj), true);
        }
    }

    public function objToString($obj, $stringify)
    {
        $str = "";
        $obj = $this->objToArray($obj, true);

        foreach ($obj as $key => $el) {
            if ($key == sizeof($obj) - 1) {
                $str .= $stringify ? "'" . $el . "'" : $el;
            } else {
                $str .= $stringify ? "'" . $el . "', " : $el . ", ";
            }
        }

        return $str;
    }
}