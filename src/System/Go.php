<?php

namespace App\System;

use App\Dictionary\Preposition;
use App\Dictionary\Subject;
use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Scene;

class Go
{

    public static function to(Subject $direction, Scene $target): void
    {
        $key = new HotKeySet($direction);
        $key->addKey(Verb::GO, preposition: Preposition::TO, callback: function () use ($target){
            return $target;
        });
        GameEngine::addHotKey($key);
    }

}