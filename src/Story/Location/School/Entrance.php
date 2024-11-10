<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Entrance
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Eingangshalle";
        return GameEngine::checkInput();
    }

}