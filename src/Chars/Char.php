<?php

namespace App\Chars;

use App\System\Out;

abstract class Char
{
    public abstract static function setup(): void;

    public static function randomize(&$count, $list, &$text): void
    {
        $count = rand(0,count($list)-1);
        $text = $list[$count];
    }

    public static function print(string $text): void
    {
        if($text)
            Out::printLn($text);
    }

}