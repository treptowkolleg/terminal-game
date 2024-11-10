<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Playground
{

    public static function basketball(): Scene
    {
        GameEngine::resetHotKeys();
        GameEngine::$sceneTitle = "Basketballplatz";
        return GameEngine::checkInput();
    }

}