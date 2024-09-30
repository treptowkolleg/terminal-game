<?php

namespace App\System;

class In
{

    public static function readLn($text = "Aktion: "): string
    {
        return strtolower(readline($text));
    }

}