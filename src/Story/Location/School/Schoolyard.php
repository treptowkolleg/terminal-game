<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Schoolyard
{

    public static function north(): Scene
    {
        GameEngine::$sceneTitle = "Hinterer Schulhof";
        return GameEngine::checkInput();
    }

    public static function south(): Scene
    {
        GameEngine::$sceneTitle = "Vorderer Schulhof";
        return GameEngine::checkInput();
    }

}