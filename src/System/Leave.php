<?php

namespace App\System;

use App\Dictionary\Verb;
use App\GameEngine;
use App\Story\Scene;

class Leave
{

    public static function from(string $location, Scene $target): void
    {
        $key = new HotKeySet(new SceneObject($location, $location, function (){}));
        $key->addKey(Verb::LEAVE, callback: function () use ($target){
            return $target;
        });
        GameEngine::addHotKey($key);
    }

}
