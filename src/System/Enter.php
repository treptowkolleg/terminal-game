<?php

namespace App\System;

use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Scene;

class Enter
{

    public static function to(string $location, Scene $target): void
    {
        $key = new HotKeySet(new SceneObject($location, $location, function (){}));
        $key->addKey(Verb::ENTER, callback: function () use ($target){
            return $target;
        });
        GameEngine::addHotKey($key);
    }

}
