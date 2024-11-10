<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class ClassRoom
{

    public static function interior(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Klassenraum";
        return GameEngine::checkInput();
    }

}