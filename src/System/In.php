<?php

namespace App\System;

class In
{

    public static function readLn($text = "░░▒ "): string
    {
        return strtolower(readline($text));
    }

}