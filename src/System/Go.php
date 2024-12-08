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

    public static function debug(string $sceneName, Scene $scene): void
    {
        $key = new HotKeySet(new SceneObject($sceneName,$sceneName,function (){}));
        $key->addKey(Verb::GO, preposition: Preposition::TO, callback: function () use ($scene){
            return $scene;
        });
        GameEngine::addHotKey($key);
    }

}
