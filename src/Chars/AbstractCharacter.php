<?php

namespace App\Chars;

use App\Story\Scene;

abstract class AbstractCharacter
{
    public abstract static function setup(): void;

}