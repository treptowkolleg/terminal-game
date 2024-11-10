<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Street
{

    public static function one(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Kiefholzstraße";
        return GameEngine::checkInput();
    }

    public static function two(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Baumschulenstraße";
        return GameEngine::checkInput();
    }

    public static function three(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Mosischstraße";
        return GameEngine::checkInput();
    }

}