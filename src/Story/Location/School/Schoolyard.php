<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Schoolyard
{

    public static function north(): Scene
    {
        GameEngine::$sceneTitle = "Hinterer Schulhof";
        return Scene::EXIT;
    }

    public static function south(): Scene
    {
        GameEngine::$sceneTitle = "Vorderer Schulhof";
        return Scene::EXIT;
    }

}