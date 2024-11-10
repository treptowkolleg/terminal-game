<?php

namespace App\Story\Location;

use App\GameEngine;
use App\Story\Scene;

class Bakery
{

    public static function interior(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Backbär";
        return GameEngine::checkInput();
    }

}