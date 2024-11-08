<?php

namespace App\Story\Location\School;

use App\GameEngine;
use App\Story\Scene;

class Cafeteria
{

    public static function interior(): Scene
    {
        GameEngine::$sceneTitle = "Cafeteria";
        return Scene::EXIT;
    }

}