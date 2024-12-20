<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Shed
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Schuppen - Innen";
        return GameEngine::checkInput();
    }

    public static function exterior(): Scene
    {
        GameEngine::$sceneTitle = "Vor dem Schuppen";
        return GameEngine::checkInput();
    }

}