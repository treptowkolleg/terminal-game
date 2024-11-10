<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class GarbagePlace
{

    public static function exterior(): Scene
    {
        GameEngine::$sceneTitle = "Mülltonnenbereich";
        return GameEngine::checkInput();
    }

}