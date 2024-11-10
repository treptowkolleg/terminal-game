<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Gym
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "In der Sporthalle";
        return GameEngine::checkInput();
    }

    public static function exterior(): Scene
    {
        GameEngine::$sceneTitle = "Vor der Sporthalle";
        return GameEngine::checkInput();
    }

}